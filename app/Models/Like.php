<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'galeri_id',
        'user_id',
        'ip_address'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function galeri(){
        return $this->belongsTo(Galeri::class);
    }
}
