<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    //menampilkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'program'=> 'required|string|max:255',
            'keterangan'=> 'required|string|max:255',
            'deskripsi'=> 'required|string',
        ]);

        Program::create($validatedData);

        return redirect()->route('admin.program.index')->with('success','Program Keahlian berhasil ditambahkan.');
    }
    //menampilkan detail
    public function show($id)
    {
        $programs = Program::findOrFail($id);
        return view('admin.program.show', compact('programs'));
    }
    //menampilkan edit
    public function edit($id)
    {
        $programs = Program::findOrFail($id);
        return view('admin.program.edit', compact('programs'));
    }
    //memperbaharui data
    public function update(Request $request, $id)
    {
        //validasiinput
        $validatedData = $request->validate([
            'program'=> 'required|string|max:255',
            'keterangan'=> 'required|string|max:255',
            'deskripsi'=> 'required|string',
        ]);

        //cari data berdasarkan id
        $programs = Program::findOrFail($id);

        //update data ke phpmyadmin
        $programs->update($validatedData);

        return redirect()->route('admin.program.index')->with('success','Program Keahlian berhasil diperbaharui');
    }
    //menghapus data
    public function destroy($id)
    {
        $programs = Program::findOrFail($id);
        $programs->delete();

        return redirect()->route('admin.program.index')->with('success','Program Keahlian berhasil dihapus.');
    }
}
