@extends('layouts.admin')

@section('content')
<div class=" container-fluid py-4">
    <!--header-->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Galeri & Foto</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.galeri.index') }}" class="text-decoration-none">Galeri</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lihat Foto</li>
                </ol>
            </nav>
        </div>
        <!--tombol kembali-->
        <div>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <div class="row g-4">
            <!--judul-->
            <div class="col-md-7">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul</label>
                    <div class="form-control bg-light p-3 border rounded text-dark fw-semibold" style="min-height:48px;">
                        {{ $galeris->judul }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Diunggah</label>
                    <div class="form-control bg-light p-2 border rounded text-muted">
                        @if (!empty($galeris->tanggal_unggah))
                        {{ \Carbon\Carbon::parse($galeris->tanggal_unggah)->translatedFormat('d F Y') }}
                        @elseif(!empty($galeris->created_at))
                        {{ $galeris->created_at->translatedFormat('d F Y ') }}
                        @else
                        -
                        @endif
                    </div>
                </div>
            </div>
            <!--foto-->
            <div class="col-md-5">
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto</label>
                    <!--kotak foto-->
                    <div class="border rounded p-2 text-center bg-light shadow-sm" style="max-height: 350px; overflow: hidden;">
                        @if ($galeris->foto)
                        <img src="{{ asset('storage/' . $galeris->foto) }}" alt="{{ $galeris->judul }}" class="img-fluid rounded" style="max-height: 320px; object-fit: contain;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection