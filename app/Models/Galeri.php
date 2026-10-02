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

    public function isLikedByGuest(?string $ip = null): bool {
        //kalo user lagi login, masuk nya gimana user_id
        if(auth()->check()){
            return $this->likes()->where('user_id', auth()->id())->exists();
        }

        //jika tamu, masuknya gmn ip
        $clientIp = $ip ?? request()->ip();

        if(!$clientIp){
            return false;
        }
        return $this->likes()->where('ip_address', $clientIp)->exists();
    }

    
    
}
