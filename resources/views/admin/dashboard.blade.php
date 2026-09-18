@extends('layouts.admin')

@section('content')

<div class="card border-0 shadow-sm bg-white mb-4">
    <div class="card-body p-4">
        <h3 class="fw-bold text-dark mb-1">Selamat datang di dasbor admin</h3>
        <p class="text-secondary mb-0"> Kelola konten website Sistem Informasi SMKN 4 Bogor dengan mudah.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <!--program keahlian-->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="bi bi-award-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary fw-semibold mb-0">Program Keahlian</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalProgram ?? 0 }}</h2>
                    </div>
                </div>
                <hr class="my-3 text-secondary opacity-25">
                <a href="{{ route('admin.program.index') }}" class="text-primary text-decoration-none fw-semibold small d-flex align-items-center justify-content-between">
                    <span>Lihat detail</span>
                </a>
            </div>
        </div>
    </div>
    <!--galeri-->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="bi bi-images fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary fw-semibold mb-0">Galeri</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalGaleri ?? 0 }}</h2>
                    </div>
                </div>
                <hr class="my-3 text-secondary opacity-25">
                <a href="{{ route('admin.galeri.index') }}" class="text-primary text-decoration-none fw-semibold small d-flex align-items-center justify-content-between">
                    <span>Lihat detail</span>
                </a>
            </div>
        </div>
    </div>
    <!--artikel dan berita-->
    <div class="col-md-4">
        <div class="card-border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="bi bi-newspaper fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary fw-semibold mb-0">Artikel & Berita</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalArtikel ?? 0 }}</h2>
                    </div>
                </div>
                <hr class="my-3 text-secondary opacity-25">
                <a href="{{ route('admin.artikel.index') }}" class="text-primary text-decoration-none fw-semibold small d-flex align-items-center justify-content-between">
                    <span>Lihat detail</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--bagian bawah-->
<div class="row g-4">
    <!--artikel-->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark">Artikel Terbaru</h5>
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-sm btn-outline-primary fw-semibold">Lihat Semua</a>
                </div>

                <!--artikel dari crud-->
                <div class="d-flex flex-column gap-3">
                    @forelse($artikelTerbaru ?? [] as $artikel)
                    <div class="card border-0 bg-light p-2">
                        <div class="row g-0 align-items-center">
                            <div class="col-3 col-sm-2">
                                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid rounded-2 object-fit-cover" alt="{{ $artikel->judul }}" style="height: 70px; width: 100%;">
                            </div>
                            <div class="col-9 col-sm-10 ps-3">
                                <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $artikel->judul }}</h6>
                                <p class="text-secondary small mb-1 text-truncate" style="max-width: 100%;">
                                    {{ Str::limit(strip_tags($artikel->isi ?? $artikel->ringkasan), 80) }}
                                </p>
                                <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->isoFormat('D MMMM YYYY') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-journal-x fs-2 d-block mb-2"></i>
                        <span>Belum ada artikel yang ditambahkan.</span>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!--kotak galeri-->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark">Galeri Terbaru</h5>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-primary fw-semibold">Lihat Semua</a>
                </div>
                <!--galeri dari CRUD-->
                <div class="d-flex flex-column gap-3">
                    @forelse($galeriTerbaru ?? [] as $galeri)
                    <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="height: 110px">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-100 h-100 object-fit-cover" alt="{{ $galeri->judul }}">

                        <!--judul-->
                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white d-flex flex-column justify-content-end"
                        style="background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent); height: 100%">
                        <h6 class="fw-bold mb-0 text-truncate text-white" title="{{ $galeri->judul }}" style="font-size: 0.875rem;">
                            {{ $galeri->judul }}
                        </h6>
                        <small class="text-white-50 d-flex align-items-center gap-1" style="font-size: 0.7rem;">
                            {{ \Carbon\Carbon::parse($galeri->created_at)->isoFormat('D MMMM YYYY') }}
                        </small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-image fs-2 d-block mb-2"></i>
                        <span>Belum ada foto galeri.</span>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
