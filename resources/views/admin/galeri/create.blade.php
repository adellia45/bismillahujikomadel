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
                    <li class="breadcrumb-item active" aria-current="page">Tambah Galeri</li>
                </ol>
            </nav>
        </div>
        <!--tombol kembali-->
        <div>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali </a>
        </div>
    </div>

    <!--form edit-->
    <form action="{{ route('admin.galeri.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card border-0 shadow-sm p-4">
            <div class="row g-4">
                <!--judul-->
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Foto</label>
                        <input type="text"
                        class="form-control @error('judul') is-invalid @enderror"
                        id="judul"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul foto"
                        required>
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--tanggal_unggah-->
                    <div class="mb-3">
                    <label for="tanggal_unggah" class="form-label fw-bold">Tanggal Diunggah</label>
                    <input type="date"
                    class="form-control @error('tanggal_unggah') is-invalid @enderror"
                    id="tanggal_unggah"
                    name="tanggal_unggah"
                    value="{{ old('tanggal_unggah', date('Y-m-d')) }}"
                    required>
                    @error('tanggal_unggah')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <!--foto-->
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">Foto</label>
                        <!--kotakfoto-->
                        <div class="mb-3 border rounded p-2 text-center bg-light" style="max-height: 200px; overflow: hidden;">
                            <img id="preview-foto" src="#" alt="Preview Foto" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">  
                        </div>
                        <input type="file"
                        class="form-control @error('foto') is-invalid @enderror"
                        id="foto"
                        name="foto"
                        accept="image/*"
                        onchange="previewImage(event)"
                        required>
                        <small class="text-muted d-block mt-1">*Format: JPG, JPEG, PNG, GIF (Maks 2MB)</small>
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!--tombol batal-->
        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-light px-4 border">Batal</a>
            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
        </div>
    </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview-foto');
                output.src = reader.result;
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
    @endsection