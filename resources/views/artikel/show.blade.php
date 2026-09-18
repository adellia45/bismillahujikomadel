@extends('layouts.app')

@section('content')


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!--judul-->
            <h1 class="fw-bold text-dark  mb-3">{{ $artikels->judul }}</h1>

            <!--tanggal unggah-->
            <p class="text-muted small mb-4">
                {{ \Carbon\Carbon::parse($artikels->tanggal_unggah)->isoFormat('D MMMM YYYY') }}
            </p>

            <!--gambar-->
            @if ($artikels->gambar)
            <img src="{{ asset('storage/' . $artikels->gambar) }}" class="img-fluid rounded-3 mb-4 w-100" alt="{{ $artikels->judul }}">
            @endif

            <!--isi-->
            <div class="lh-lg text-dark" style="white-space: pre-line;">
                {{ $artikels->isi }}
            </div>

            <!--kembali-->
            <div class="mt-5">
                <a href="javascript:history.back()" class="btn btn-outline-secondary">
                     Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection