<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('foto')->store('galeris','public');

        Galeri::create([
            'judul' => $request->judul,
            'foto'  => $path,
        ]);

        return redirect()->route('galeri.index')->with('success','Galeri berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::with(['likes', 'comments'])->findOrFail($id);

        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required',
        ]);

        $data =[
            'judul' => $request->judul,
        ];

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $data['foto'] = $request->file('foto')->store('galeris','public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success','Galeri berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
    }
    $galeri->delete();

    return redirect()->route('galeri.index')->with('success','Galeri berhasil dihapus!');

    }

    public function toggleLike(Request $request, Galeri $galeri)
    {
        if(auth()->check()){
            //jika user logged in
            $like = $galeri->likes()->where('user_id', auth()->id())->first();

            if($like){
                $like->delete(); //unlike
            } else {
                $galeri->likes()->create([
                    'user_id'=> auth()->id(),
                ]);
            }
        } else {
            //jika tamu pake ip address
            $ip = $request->ip();
            $like = $galeri->likes()->where('ip_address', $ip)->first();

            if($like){
                $like->delete(); //unlike
        } else {
            $galeri->likes()->create([
                'ip_address' => $ip,
                'user_id' => null,
            ]);
        }
        }
        return back();
    }
}