<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    //halaman daftar program
    public function index()
    {
        $programs = Program::all();
        return view("program-keahlian", compact("programs"));
    }

    public function show($id)
    {
        $programs = Program::findOrFail($id);
        return view("program-keahlian-detail", compact("programs"));
    }
}