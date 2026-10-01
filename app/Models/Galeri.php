<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'tanggal_unggah', 'foto'];

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest(); //komentar terbaru biar selalu di atas
    }

    public function isLikedBy($user) {
        if(!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isLikedByGuest($ip) {
        if(auth()->check()){
            return $this->likes()->where('user_id', auth()->id())->exists();
        }
        return $this->likes()->where('ip_address', $ip)->exists();
    }

    
    
}
