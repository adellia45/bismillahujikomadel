@extends('layouts.admin')

@section('content')
<div class=" container-fluid py-4">
    <!--header-->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Program Keahlian Kr4bat</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Program Keahlian</li>
                </ol>
            </nav>
        </div>
        <!--tombol tambah jurusan-->
        <div>
            <a href="{{ route('admin.program.create') }}" class="btn btn-primary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Jurusan </a>
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
                            <th class="text-center py-3 px-3" style="width: 5%;">No</th>
                            <th class="py-3 px-3" style="width: 20%;">Program Keahlian</th>
                            <th class="py-3 px-3" style="width: 25%;">Keterangan</th>
                            <th class="py-3 px-3" style="width: 50%;">Deskripsi</th>
                            <th class="text-center py-3 px-3" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $index => $item)
                        <tr>
                            <td class="text-center fw-semibold px-3">{{ $index + 1 }}</td>
                            <td class="fw-bold text-primary px-3">{{ $item->program }}</td>
                            <td class="fw-semibold text-dark px-3">{{ $item->keterangan }}</td>
                            <td class="text-muted small px-3">
                                {{ Str::limit($item->deskripsi, 80) }}
                            </td>
                            <td class="text-center px-3">
                                <div class="d-flex justify-content-center gap-1">
                                    <!--read-->
                                    <a href="{{ route('admin.program.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!--update-->
                                    <a href="{{ route('admin.program.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!--delete-->
                                    <form action="{{ route('admin.program.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program keahlian ini?')">
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
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data program keahlian. Silahkan klik tombol <strong>Tambah Jurusan</strong>
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