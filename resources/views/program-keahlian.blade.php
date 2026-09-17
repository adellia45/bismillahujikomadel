@extends('layouts.app')

@section('content')

<!--hero-->
<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative">
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda </a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page"> Program Keahlian</li>
            </ol>
        </nav>

    <h1 class="display-4 fw-bold mb-3 text-white">Program Keahlian</h1>
    <p class="lead col-lg-8 mx-auto text-white-50 fs-5 mb-0">
        SMKN 4 Bogor memiliki berbagai program keahlian yang dirancang untuk membekali siswa dengan keterampilan sesuai kebutuhan industri masa depan.
    </p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        <div class="row g-4">
            @forelse($programs as $item)
            <div class="col-md-6" id="{{ Str::slug($item->program) }}">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body p-4 d-flex flex-column">
                        <h3 class="card-title fw-bold text-primary mb-1">
                            {{ $item->program }}
                        </h3>
                        <h5 class="fw-bold text-dark mb-3">
                            {{ $item->keterangan }}
                        </h5>
                        <p class="card-text text-muted text-justify lh-base mb-0">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada data program keahlian yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection