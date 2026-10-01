@extends('layouts.admin')

@section('content')
<div class=" container-fluid py-4">
    <!--header-->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Galeri Kr4bat</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
        <!--tombol tambah foto-->
        <div>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Foto </a>
        </div>
    </div>

    <!--notif success-->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
        <i class="bi bi-check-cirle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!--kotak table-->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 50px;">No</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 120px;">Foto</th>
                            <th scope="col" class="px-4 py-3">Judul</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 180px;">Tanggal Unggah</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galeris as $index => $item)
                        <tr>
                            <td class="px-4 py-3 text-center fw-semibold">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="img-thumbnail rounded" style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                <span class="badge bg-secondary">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 fw-semibold text-primary px-3">{{ $item->judul }}</td>
                            <td class="px-4 py-3 text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal_unggah)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <!--read-->
                                    <a href="{{ route('admin.galeri.show', $item->id) }}" class="btn btn-sm btn-info text-white d-inline align-items-center justify-content-center" style="width: 38px; height: 32px;" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!--update-->
                                    <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-sm btn-warning text-white d-inline align-items-center justify-content-center" style="width: 38px; height: 32px;" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!--delete-->
                                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-inline align-items-center justify-content-center" style="width: 38px; height: 32px;" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.galeri.interactions', $item->id) }}" class="btn btn-sm btn-outline-info d-inline align-items-center justify-content-center" style="width: 38px; height: 32px;" title="Lihat Komentar & Like">
                                        <i class="bi bi-chat-heart"></i>
                                        @if (($item->comments_count ?? $item->comments-count()) > 0)
                                        <span class="positon-absolute top-0 start-100 translate-middle badge rounded-pill bg-info text-white" style="fon0.65rem">
                                        {{ $item->comments_count ?? $item->comments->count() }}
                                        </span>
                                        @endif
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data galeri foto. Silahkan klik tombol <strong>Tambah Foto</strong>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection