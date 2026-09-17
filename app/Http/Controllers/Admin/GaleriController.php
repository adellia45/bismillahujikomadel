<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GaleriController extends Controller
{
    //menampilkan halaman utama tabel galeri
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris')); 
    }

    public function create() {
        $galeris = Galeri::all();
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_unggah'=> 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //process upload ke folder storage/app/public/galeri
        $path = $request->file('foto')->store('galeri', 'public');

        //simpan data ke database phpmyadmin
        Galeri::create([
            'judul'=> $request->judul,
            'tanggal_unggah' => $request->tanggal_unggah,
            'foto'=> $path,
        ]);
        
        //info pesan sukses
        return redirect()->route('admin.galeri.index')->with('success','Foto Galeri berhasil ditambahkan!');

    }

    public function show($id)
    {
        $galeris = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('galeris'));
    }

    public function edit($id)
    {
        $galeris = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeris'));
    }

    public function update(Request $request, $id)
    {
        //validasi input

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_unggah'=> 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galeris = Galeri::findOrFail($id);

        //update data judul
        $galeris->judul = $request->judul;

        $galeris->tanggal_unggah = $request->tanggal_unggah;

        //jika user memilih foto baru
        if ($request->hasFile('foto')) {
            //hapus foto lama jika ada di storage
            if ($galeris->foto && Storage::disk('public')->exists($galeris->foto)) {
                Storage::disk('public')->delete($galeris->foto);
            }

            //simpanfoto baru ke folder storage/app/public/galeri
            $path = $request->file('foto')->store('galeri', 'public');
            $galeris->foto = $path;
    }
    //simpan perubahan ke phpmyadmin
    $galeris->save();
    return redirect()->route('admin.galeri.index')->with('success','Data Foto berhasil diperbaharui!');
    }

    public function destroy($id)
    {
        $galeris = Galeri::findOrFail($id);

        //hapus file foto dari folder storage
        if ($galeris->foto && Storage::disk('public')->exists($galeris->foto)){
            Storage::disk('public')->delete($galeris->foto);
        }
        //hapus dari database
        $galeris->delete();
        return redirect()->route('admin.galeri.index')->with('success','Foto berhasil dihapus!');
    }
}