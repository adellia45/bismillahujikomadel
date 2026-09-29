<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    //simpen rating di hal publik
    public function store(Request $request){
        $request->validate([
            'bintang' => 'required|integer|min:1|max:5',
            'nama'=> 'nullable|string|max:100',
            'ulasan'=> 'nullable|string|max:500',
        ]);
        Rating::create([
            'bintang'=> $request->bintang,
            'nama'=> $request->nama ?? 'Anonim',
            'ulasan'=> $request->ulasan,
        ]);
    return back()->with('success_rating','Terima kasih atas penilaian Anda!');
    }
}

