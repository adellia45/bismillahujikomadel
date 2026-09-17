<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProgram'=> Program::count(),
            'totalArtikel'=> Artikel::count(),
            'totalGaleri'=> Galeri::count(),
            'artikelTerbaru' => Artikel::latest()->take(3)->get(),
            'galeriTerbaru' => Galeri::latest()->take(3)->get(),
        ]);

        return view('admin.dashboard', compact('totalProgram', 'totalGaleri', 'totalArtikel'));
    }
}