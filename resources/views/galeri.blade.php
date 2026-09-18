@extends('layouts.app')

@section('content')

<!--hero-->
<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative py-5" >
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Galeri</li>
            </ol>
        </nav>

        <h1 class="display-4 fw-bold mb-3 text-white">Galeri Kr4bat</h1>
        <p class="lead col-lg-8 mx-auto text-white fs-5 mb-0">
            Dokumentasi kegiatan fasilitas, prestasi, dan momen berharga di SMKN 4 Bogor.
        </p>
    </div>
</section>

<!--isi galeri-->
<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        <div class="row g-4">
            
            @forelse($galeris as $galeri)
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden d-flex flex-column">
                        <div class="ratio ratio-1x1 bg-secondary-subtle">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" 
                             class="card-img-top object-fit-cover" 
                             alt="{{ $galeri->judul }}" >
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1 p-4">
                            <h5 class="card-title fw-bold text-dark mb-2 text-truncate" title="{{ $galeri->judul }}">
                                {{ $galeri->judul }}
                            </h5>
                            
                            <!--tanggal unggah-->
                            <div class="mt-auto">
                            <p class="card-text text-muted small m-0 d-flex align-items-center gap-1">
                                {{ $galeri->created_at ? $galeri->created_at->isoFormat('D MMMM YYYY') : '' }}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5 mb-0">Belum ada foto galeri yang diunggah.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

@endsection