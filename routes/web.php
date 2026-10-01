<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RatingController; 
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;

//form login Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//halaman dashboard admin (harus login pokoknya)
route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    //program keahlian
    route::resource('program', AdminProgramController::class);
    //galeri
    route::resource('galeri', AdminGaleriController::class);
    //lihat daftar komen & like perfoto
    route::get('/galeri/{galeri}/interactions', [AdminGaleriController::class,'showInteractions'])->name('galeri.interactions');
    //buat hapus komen
    route::delete('/comment/{comment}', [AdminGaleriController::class,'destroyComment'])->name('comment.destroy');
    //buat hapus like
    route::delete('/like/{like}', [AdminGaleriController::class,'destroyLike'])->name('like.destroy');
    //artikel
    route::resource('artikel', AdminArtikelController::class);
});

route::get('/', [BerandaController::class,'index'])->name('beranda');

Route::get('/program-keahlian', [ProgramKeahlianController::class,'index'])->name('program-keahlian');
Route::get('/program-keahlian/{id}', [ProgramKeahlianController::class,'show'])->name('program-keahlian.show');

Route::resource('artikel', ArtikelController::class);
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::resource('galeri', GaleriController::class);
Route::get('/galeri/{galeri}', [GaleriController::class,'show'])->name('galeri.show');
//like
Route::post('/galeri/{galeri}/like', [GaleriController::class,'toggleLike'])->name('galeri.like');
//komen
Route::post('/galeri/{galeri}/comment', [CommentController::class,'storeComment'])->name('galeri.comment.store');
Route::delete('/comment/{comment}', [CommentController::class,'destroyComment'])->name('galeri.comment.destroy');

//route untuk rating
Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');


