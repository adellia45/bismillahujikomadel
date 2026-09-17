<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required',
            'isi'    => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('gambar')->store('artikels','public');

        Artikel::create([
            'judul' => $request->judul,
            'isi'   => $request->isi,
            'gambar'=> $path
        ]);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //mengambil data berdasarkan ID
        $artikels = Artikel::findOrFail($id);

        return view('artikel.show', compact('artikels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikels)
    {
        return view('admin.artikel.edit', compact('artikels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikels)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi'   => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            if ($artikels->gambar) {
                Storage::disk('public')->delete($artikels->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel','public');
            }

            $artikels->update($data);
            
            return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artikels = Artikel::findOrFail($id);

        if ($artikels->gambar && Storage::disk('public')->exists($artikels->gambar)) {
            Storage::disk('public')->delete($artikels->gambar);
        }
        $artikels->delete();

        return redirect('artikel.index')->with('success','Artikel berhasil dihapus!');
    }
}
