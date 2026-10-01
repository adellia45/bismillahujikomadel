<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeComment(Request $request, Galeri $galeri){
        $request->validate([
            'nama_pengirim' => 'required|string|max:50',
            'isi_komentar' => 'required|string|max:500',
        ]);

        $comment = $galeri->comments()->create([
            'nama_pengirim'=> $request->nama_pengirim,
            'isi_komentar'=> $request->isi_komentar,
            'ip_address'=> $request->ip(),
        ]);

        //simpaN ID komentar ke session browse user agar user bisa hapus komen miliknya sendiri
        $myComments = session()->get('my_comments', []);
        $myComments[] = $comment->id;
        session()->put('my_comments', $myComments);

        return back()->with('success','Komentar berhasil ditambahkan!');
    }

    public function destroyComment(Comment $comment){
        //cek id apakah sudah ada id komentar atau belum di browser
        $myComments = session()->get('my_comments', []);

        if(in_array($comment->id, $myComments) || (auth()->check() && auth()->id() === $comment->user_id)){
            $comment->delete();

        //hapus dari sesi
        $myComments = array_diff($myComments, [$comment->id]);
        session()->put('my_comments', $myComments);

        return back()->with('success','Komentar berhasil dihapus!');
    }


    return back()->with('error','Anda tidak memiliki akses untuk menghapus komentar');
}
}

