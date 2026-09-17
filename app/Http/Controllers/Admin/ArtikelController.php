<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambil semua data artikel dari database
        $artikels = Artikel::latest()->get();
        //ngirim variabel ke index.blade.php
        return view("admin.artikel.index", compact("artikels"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.artikel.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_unggah'=> 'required|',
        ]);

        $data = [
            'judul'=> $request->judul,
            'isi'=> $request->isi,
            'tanggal_unggah'=> $request->tanggal_unggah,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikels = Artikel::findOrFail($id);
        return view('admin.artikel.show', compact('artikels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikels = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_unggah'=> 'required|',
        ]);

        $artikels= Artikel::findOrFail($id);

        $data = [
            'judul'=> $request->judul,
            'isi'=> $request->isi,
            'tanggal_unggah'=> $request->tanggal_unggah,
        ];

        //cek apakah ada file gambar di storage
        if ($request->hasFile('gambar')) {
            //hapus gambar lama kalo ada
            if ($artikels->gambar && Storage::disk('public')->exists($artikels->gambar)) {
                Storage::disk('public')->delete($artikels->gambar);
            }
            //simpan data baru
            $data['gambar'] = $request->file('gambar')->store('artikels', 'public');
        }
        //update data di database phpmyadmin
        $artikels->update($data);
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikels = Artikel::findOrFail($id);
        $artikels->delete();

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil dihapus!');
    }
}
