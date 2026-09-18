@extends('layouts.app')

@section('content')

<section class="hero-section d-flex align-items-center justify-content-center text-center position relative py-5">
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Artikel</li>
            </ol>
        </nav>

        <h1 class="display-4 fw-bold mb-3 text-white">Artikel Kr4bat</h1>
        <p class="lead col-lg-8 mx-auto text-white-50 fs-5 mb-0">
            Informasi terbaru seputar kegiatan, prestasi, dan informasi penting dari SMKN 4 Bogor.
        </p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        <div class="row g-4">

        @forelse($artikels as $artikel)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 shadow-sm border-0 overflow hidden d-flex flex-column">

            <!--gambar-->
            <div class="ratio ratio-16x9 bg-secondary-subtle">
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top object-fit-cover" alt="{{ $artikel->judul }}">
            </div>

            <!--tanggal, judul, dll-->
            <div class="card-body d-flex flex-column flex-grow-1 p-4">
                <!--judul-->
                <h5 class="card-title fw-bold text-dark fs-6 mb-2">
                {{ $artikel->judul }}
                </h5>
                <!--isi-->
                <p class="card-text text-muted small mb-3">{{ Str::limit($artikel->isi ?? $artikel->ringkasan, 100) }}</p>
                <!--tanggal-->
                <div class="mt-auto pt-3 border-top">
                    @if (!empty($artikel->tanggal_unggah ?? $artikel->created_at))
                    <small class="text-muted d-flex align-items-center gap-1 mb-2">
                        {{ \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->isoFormat('D MMMM YYYY')}}
                    </small>
                    @endif
                <!--tombol baca selengkapnya-->
                    <a href="{{ url('/artikel/'. $artikel->id) }}" class="btn btn-primary w-100 fw-semibold">
                        Baca Selengkapnya
                    </a>
            </div>
            </div>
            </div>
        </div>
        @empty
        <!--jika belum ada data dari admin-->
        <div class="col-12 text-centerpy-5">
            <p class="text-muted fs-5 mb-0">Belum ada artikel atau berita yang diterbitkan.</p>
        </div>
        @endforelse
        </div>
    </div>
</section>

@endsection