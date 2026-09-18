@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <!--header-->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Artikel & Berita</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.artikel.index') }}" class="text-decoration-none">Artikel</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lihat Artikel</li>
                </ol>
            </nav>
        </div>
        <!--tombol kembali-->
        <div>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali </a>
        </div>
    </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <!--judul-->
                        <div class="mb-4">
                             <label class="form-label fw-semibold text-muted small uppercase">Judul</label>
                             <div class="bg-light p-3 border rounded-3">
                              <h5 class="fw-semibold text-dark m-0">{{ $artikels->judul }}</h5>
                            </div>
                             </div>
                        
                        <!--tanggalunggah-->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small uppercase">Tanggal Unggah</label>
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-dark fw-semibold">
                                        {{ \Carbon\Carbon::parse($artikels->tanggal_unggah)->isoFormat
                                        ('D MMMM YYYY') }}
                                </span>
                            </div>
                        </div>
                        <!--isi-->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small uppercase">Isi</label>
                            <div class="p-3 bg-light rounded-3 border" style="min-height: 200px;">
                                <div class="text-dark fw-semibold style-decoration" style="white-space: pre-line; line-height: 1.8;">
                                    {{ $artikels->isi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--foto-->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="card-body">
                    <label class="form-label fw-semibold text-muted small uppercase">Foto</label>

                    <!--frame foto-->
                    <div class="border rounded-3 p-2 text-center bg-light mb-2 position-relative overflow-hidden" style="min-height: 250px; display: flex; align-items: center; justify-content: center;">
                        @if ($artikels->gambar)
                        <img src="{{ asset('storage/' . $artikels->gambar) }}"
                        alt="{{ $artikels->judul }}"
                        class="img-fluid rounded"
                        style="max-height: 280px; object-fit: cover; width: 100%;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection