<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal_unggah',
        ]; 

        protected $casts = [
            'tanggal_unggah'=> 'date',
        ];
}
