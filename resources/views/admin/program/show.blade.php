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
                    <li class="breadcrumb-item active"  aria-current="page">Lihat Program Keahlian</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.program.index') }}" class="btn btn-outline-secondary px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <!--nama program keahlian-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-secondary mb-2">Nama Program Keahlian</h6>
                        <div class="p-3 bg-light rounded border fs-5 fw-regular text-dark">
                            {{ $programs->program }}
                        </div>
                    </div>
                </div>
                <!--keterangan-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-secondary mb-2">Keterangan</h6>
                        <div class="p-3 bg-light rounded border fs-5 fw-regular text-dark">
                            {{ $programs->keterangan ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- kanan deskripsi-->
             <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <!--deskripsi-->
                        <h6 class="fw-bold text-secondary mb-2">Deskripsi</h6>
                        <div class="p-3 bg-light rounded border fs-5 fw-regular text-dark style-description" style="min-height: 180px; white-space: pre-line;">
                            {{ $programs->deskripsi ?? 'Tidak ada deksripsi.' }}
                        </div>
                    </div>
                </div>
             </div>
        </div>

</div>

@endsection