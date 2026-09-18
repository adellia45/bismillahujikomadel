@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <!--header-->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Artikel Kr4bat</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                </ol>
            </nav>
        </div>
        <!--tombol tambah foto-->
        <div>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Artikel </a>
        </div>
    </div>
    <!--notif success-->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
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
                            <th scope="col" class="px-4 py-3">Judul</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 30%;">Isi</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 110px;">Gambar</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 160px;">Tanggal Unggah</th>
                            <th scope="col" class="px-4 py-3 text-center" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikels as $index => $item)
                        <tr>
                            <!--no-->
                            <td class="px-4 py-3 text-center fw-semibold">{{ $loop->iteration }}</td>
                            <!--judul-->
                            <td class="px-4 py-3 fw-semi-bold text-center">
                                {{ $item->judul }}
                            </td>
                            <!--isi-->
                            <td class="px-4 py-3 text-muted">
                                {{ Str::limit(strip_tags($item->isi), 80,'...') }}
                            </td>
                            <!--gambar-->
                            <td class="px-4 py-3 text-center">
                                @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="img-thumbnail rounded" style="width: 70px; height: 50px; object-fit: cover;">
                                @else
                                <span class="badge bg-secondary">Tidak ada gambar</span>
                                @endif
                            </td>
                            <!--tambah unggah-->
                            <td class="px-4 py-3 text-center">
                                @if ($item->tanggal_unggah)
                                {{ \Carbon\Carbon::parse($item->tanggal_unggah)->translatedFormat('d F Y') }}
                                @else
                                <span class="text-muted"></span>
                                @endif
                            </td>
                            <!--aksi-->
                            <td class="px-4 py-3 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!--read-->
                                    <a href="{{ route('admin.artikel.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!--update-->
                                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!--delete-->
                                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data artikel. Silahkan klik tombol <strong>Tambah Artikel</strong>
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