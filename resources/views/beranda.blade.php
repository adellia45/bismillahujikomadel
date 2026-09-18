@extends('layouts.app')

@section('content')

<!--bagian hero-->
<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative">
<div class="container" style="max-width:  1200px;">
    <h1 class="display-3 fw-bold mb-3 text-white">Sistem Informasi SMKN 4 Bogor</h1>
    <p class="lead col-lg-9 mx-auto text-white fs-4 mb-4">
        Platform digital yang menyediakan informasi sekolah, prestasi, kegiatan, dan karya siswa dalam satu tempat.
    </p>
    <a href="{{ url('/program-keahlian') }}" class="btn btn-primary btn-lg">Lihat Program Keahlian</a>
</div>
</section>

<!--Bagian Tentang-->
<section class="py-5 bg-white">
    <div class="container " style="max-width:  1200px;">
        <div class="text-center mb-5">
        <h2 class="fw-bold mb-3 text-dark">Mengenal Lebih Dekat SMKN 4 Bogor</h2>
        <p class="col-md-9 mx-auto text-muted mb-4 fs-5">
            SMKN 4 Bogor adalah sekolah menengah kejuruan yang berkomitmen mencetak generasi unggul, kompeten, dan berkarakter melalui pendidikan berbasis teknologi, industri, dan inovasi.
        </p>
        </div>

        <!--visi misi-->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <h4 class="fw-bold m-0 text-primary">Visi Sekolah</h4>
                        </div>
                        <p class="card-text text-secondary mb-0">
                            "Terwujudnya Sekolah Menengah Kejuruan yang unggul, berkarakter, berwawasan lingkungan, dan menghasilkan lulusan yang kompeten serta berdaya saing global."
                        </p>
                    </div>
                </div>
            </div>
            <!--misi-->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <h4 class="fw-bold m-0 text-primary">Misi Utama</h4>
                        </div>
                        <ul class="card-text text-secondary ps-3 mb-0">
                            <li class="mb-1">Menyelenggarakan pembelajaran berbasis kompetensi dan teknologi informasi.</li>
                            <li class="mb-1">Meningkatkan kerja sama industri (DUDI) nasional dan internasional.</li>
                            <li>Membentuk karakter peserta didik yang disiplin, kreatif, dan berakhlak mulia.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--angka statistik-->
        <div class="row text-center border-top border-bottom py-4 mb-4 g-3">
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primary mb-0">{{ $totalProgram ?? 0 }}</h3>
                <small class="text-muted fw-semibold">Program Keahlian</small>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primary mb-0">1.200+</h3>
                <small class="text-muted fw-semibold">Siswa Aktif</small>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primary mb-0">150+</h3>
                <small class="text-muted fw-semibold">Mitra Industri</small>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primary mb-0">A</h3>
                <small class="text-muted fw-semibold">Akreditasi Sekolah</small>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container" style="max-width:  1200px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0 mx-auto">Program Keahlian Kr4bat</h2>
            <a href="{{ route('program-keahlian') }}" class="btn btn-link text-decoration-none fw-semibold">Lihat semua program keahlian &rarr;</a>
        </div>
        
        <div class="row g-4">
            @forelse($programs ?? [] as $item)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title text-start fw-bold text-primary">{{ $item->program }}</h4>
                        <p class="card-text fw-semibold">{{ $item->keterangan }}</p>
                        <a href="{{ url('/program-keahlian#' . Str::slug($item->program)) }}" class="btn btn-primary btn-sm text-white mt-auto align-self-start">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">Belum ada data program keahlian.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!--Galeri-->
<section class="py-5 bg-white">
    <div class="container" style="max-width:  1200px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0 mx-auto">Galeri Sekolah Kr4bat</h2>
            <a href="{{ route('galeri.index') }}" class="btn btn-link text-decoration-none fw-semibold">Lihat semua galeri &rarr;</a>
        </div>

        <div class="row g-4">
            @forelse($galeris ?? [] as $galeri)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('storage/' . $galeri->foto) }}" 
                    class="card-img-top object-fit-cover" 
                    alt="{{ $galeri->judul }}"
                    style="aspect-ratio: 1 / 1; width: 100%;">

                    <div class="card-body">
                        <h6 class="card-title m-0 fw-semibold text-dark mb-2">{{ $galeri->judul }}</h6>
                    <!--tanggal-->
                    @if (!empty($galeri->created_at))
                    <small class="text-muted d-flex align-items-center gap-1">
                        {{ \Carbon\Carbon::parse($galeri->created_at)->isoFormat('D MMMM YYYY') }}
                    </small>
                    @endif
                    </div>
                </div> 
            </div>
            @empty  
            @for($i = 1; $i <= 4; $i++)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0 bg-light text-center d-flex align-items-center justify-content-center" style="aspect-ratio: 1 / 1;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-image fs-1 text-secondary mb-2"></i>
                        <p class="text-muted m-0">Foto Galeri {{ $i }}<br><small>(Data dari Admin CRUD)</small></p>
                    </div>
                </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

<!--artikel-->
<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0 mx-auto">Artikel Terkini Kr4bat</h2>
            <a href="{{ route('artikel.index') }}" class="btn btn-link text-decoration-none fw-semibold">Lihat semua artikel &rarr;</a>
        </div>
        <div class="row g-4">
            @forelse($artikels ?? [] as $artikel)
            <div class="col-md-3">
                <div class="card h-100 d-flex flex-column">
                    <!--img-->
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" 
                    class="card-img-top object-fit-cover" 
                    alt="{{ $artikel->judul }}"
                    style="aspect-ratio: 16 / 9; width: 100%;">
                    <div class="card-body d-flex  flex-column flex-grow-1">
                        <!--judul-->
                        <h5 class="card-title fw-bold text-dark fs-6 mb-2">{{ $artikel->judul }}</h5>
                        <p class="card-text text-muted small mb-3">{{ Str::limit($artikel->isi, 60) }}</p>
                    <!--tanggal-->
                    <div class="mt-auto">
                    @if (!empty($artikel->tanggal_unggah ?? $artikel->created_at))
                    <small class="text-muted d-flex align-items-center gap-1 mb-2">
                        {{ \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->isoFormat('D MMMM YYYY') }}
                    </small>
                    @endif
                    <!--tombol Detail-->
                    <a href="{{ route('artikel.show', ['artikel' =>  $artikel->id]) }}"
                    class="btn btn-outline-primary btn-sm w-100 mt-1">
                    Baca Selengkapnya
                    </a>
                    </div>
                    </div>
                </div>
            </div>
            @empty
            <!--Kartu tempat data dinamis CRUD-->
            @for($i = 1; $i <= 4; $i++)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0 bg-white text-center py-5">
                    <div class="card-body">
                        <p class="text-muted m-0">Artikel {{ $i }}<br><small>(Data dari Admin CRUD)</small></p>
                    </div>
                </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

@endsection