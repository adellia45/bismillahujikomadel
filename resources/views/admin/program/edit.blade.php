@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-3">
    <!--header-->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Program Keahlian</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.program.index') }}">Program Keahlian</a></li>
                    <li class="breadcrumb-item active"  aria-current="page">Edit Program Keahlian</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.program.index') }}" class="btn btn-outline-secondary px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
    <!--nampilin error kalo gagal-->
    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    
    <!--form edit-->
    <form action="{{ route('admin.program.update', $programs->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <!--nama program keahlian-->
                        <div class="mb-4">
                            <label for="program" class="form-label fw-bold">Nama Program Keahlian</label>
                            <input type="text" 
                            class="form-control @error('program') is-invalid @enderror"
                            id="program"
                            name="program"
                            value="{{ old('program', $programs->program) }}"
                            placeholder="Contoh : Pengembangan Perangkat Lunak dan Gim"
                            required>
                            @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--keterangan-->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <input type="text"
                            class="form-control @error('keterangan') is-invalid @enderror"
                            id="keterangan"
                            name="keterangan"
                            value="{{ old('keterangan', $programs->keterangan) }}"
                            placeholder="Contoh : Pengembangan Perangkat Lunak dan Gim">
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- kanan deskripsi-->
             <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <!--deskripsi-->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi"
                            name="deskripsi"
                            rows="6"
                            placeholder="Contoh: PPLG adalah program keahlian yang mempelajari ...">{{ old('deskripsi', $programs->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('admin.program.index') }}" class="btn btn-light px-4 border">Batal</a>
            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection