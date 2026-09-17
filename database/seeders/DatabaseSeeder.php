<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artikel::create([
            'judul' => 'Penerimaan Siswa Baru Tahun 2026',
            'isi'   => 'Pendaftaran murid baru telah dibuka. Silahkan melengkapi berkas di bagian tata usaha.',
            'gambar'=> 'artikels/default.jpg',
        ]);

        Artikel::create([
            'judul' => 'Kunjungan Industri Jurusan PPLG',
            'isi'   => 'Siswa kelas XI PPLG mengadakan kunjungan ke perusahaan software house nasional.',
            'gambar'=> 'artikels/default.jpg',
        ]);
    }
}
