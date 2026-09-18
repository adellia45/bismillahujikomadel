@extends('layouts.admin')

@section('content')
<div class=" container-fluid py-4">
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
                    <li class="breadcrumb-item active" aria-current="page">Tambah Artikel</li>
                </ol>
            </nav>
        </div>
        <!--tombol kembali-->
        <div>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali </a>
        </div>
    </div>

    <!--form edit-->
    <form action="{{ route('admin.artikel.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <!--judul-->
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">Judul</label>
                            <input type="text"
                            class="form-control @error('judul') is-invalid  @enderror"
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Masukkan judul artikel"
                            required>
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--tanggal unggah-->
                        <div class="mb-3">
                            <label for="tanggal_unggah" class="form-label fw-semibold">Tanggal Unggah</label>
                            <input type="date"
                            class="form-control @error('tanggal_unggah') is-invalid  @enderror"
                            id="tanggal_unggah"
                            name="tanggal_unggah"
                            value="{{ old('tanggal_unggah', date('Y-m-d')) }}"
                            required>
                            @error('tanggal-unggah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--isi-->
                        <div class="mb-3">
                            <label for="isi" class="form-label fw-semibold">Isi</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi" rows="8" placeholder="Tuliskan isi artikel di sini..." required>{{ old('isi') }}</textarea>
                            @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!--frame foto-->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-semibold">Foto</label>
                            <div class="border rounded-3 p-2 text-center bg-light mb-3 position-relative overflow-hidden" style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
                                <img id="preview-foto" src="#" alt="Preview Foto" class="img-fluid rounded d-none" style="max-height: 200px; object-fit: cover; width: 100%;">
                                <div id="preview-placeholder" class="text-muted">
                                    <i class="bi bi-image fs-1 d-block mb-1"></i>
                                    <small>Preview foto akan muncul di sini</small>
                                </div>
                            </div>
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                            @error('gambar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--tombol batal-->
        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light px-4 border">Batal</a>
            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
        </div>
    </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-foto');
            const placeholder = document.getElementById('preview-placeholder');

            if(input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endsection