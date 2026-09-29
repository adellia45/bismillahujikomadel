<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Program;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProgram = Program::count();
        $totalArtikel = Artikel::count();
        $totalGaleri = Galeri::count();
        $artikelTerbaru = Artikel::latest()->take(3)->get();
        $galeriTerbaru = Galeri::latest()->take(3)->get();

        //data rating
        $totalRating = Rating::count();
        $avgRating = Rating::select(DB::raw('AVG(bintang) as rata_rata'))->value('rata_rata') ?? 0;
        $latestRatings = Rating::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProgram',
            'totalArtikel',
            'totalGaleri',
            'artikelTerbaru',
            'galeriTerbaru',
            'totalRating',
            'avgRating',
            'latestRatings',
        ));
    }
}