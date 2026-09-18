<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Program;

class BerandaController extends Controller
{
    public function index()
    {
        //mengambil semua data program keahlian
        $programs = Program::all();
        $totalProgram = Program::count();

        //mengambil 4 galeri dan artikel untuk di beranda
        $galeris = Galeri::latest()->take(4)->get();
        $artikels = Artikel::latest()->take(4)->get();

        return view("beranda", compact("totalProgram", "programs","galeris","artikels"));
    }
}
