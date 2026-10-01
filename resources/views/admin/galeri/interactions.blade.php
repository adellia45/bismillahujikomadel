@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark m-0">Galeri Kr4bat</h3>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.galeri.index') }}" class="text-decoration-none">Galeri</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Interaksi Kr4bat</li>
                </ol>
            </nav>
        </div>
        <!--tombol kembali-->
        <div>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali </a>
        </div>
    </div>

<!--tampilan foto galeri-->
<div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
    <div class="card-body p-3 bg-light d-flex align-items-center gap-3">
            <img src="{{ asset('storage/' . $galeri->foto) }}" class="rounded-3 object-fit-cover" alt="{{ $galeri->judul }}" style="width: 80px; height: 90px;;">
            <div>
                <h5 class="fw-bold text-dark mb-1">{{ $galeri->judul }}</h5>
                <p class="text-muted small mb-0">{{ Str::limit($galeri->deskripsi, 120) }}</p>
                <div class="mt-2 d-flex gap-3 text-secondary small">
                    <span><i class="bi bi-heart-fill text-danger me-1"></i>{{ $galeri->likes->count() }} Suka</span>
                    <span><i class="bi bi-chat-left-text-fill text-primary me-1"></i>{{ $galeri->comments->count() }} Komentar</span>
                </div>
            </div>
    </div>
</div>

<div class="row g-4">
    <!--tabel komen-->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0"><i class="bi bi-chat-left-text me-2"></i>Daftar Komentar</h6>
                <span class="badge bg-primary rounded-pill">{{ $galeri->comments->count() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th>Pengguna</th>
                                <th>Status</th>
                                <th>Isi Komentar</th>
                                <th>Tanggal</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galeri->comments as $comment)
                            <tr>
                                <td>
                                    <span class="fw-bold d-block text-dark">{{ $comment->nama_pengirim }}</span>
                                    @if ($comment->user)
                                    <small class="text-muted">{{ $comment->user->email }}</small>
                                    @endif
                                </td>
                                <td>
                                @if ($comment->user_id)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">User</span>
                                @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Guest</span>
                                @endif
                                </td>
                                <td class="text-break" style="max-width: 220px;">
                                    {{ $comment->isi_komentar }}
                                </td>
                                <td>
                                    <small class="text-muted d-block">{{ $comment->created_at->isoFormat('DD MMMM YYYY') }}</small>
                                    <small class="text-muted opacity-75" style="font-size: 0.75rem">{{ $comment->created_at->format('H:i') }}</small>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm border-0" title="Hapus Komentar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada komentar pada foto ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--tabel like-->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0"><i class="bi bi-heart text-danger me-2"></i>Daftar Suka</h6>
                <span class="badge bg-danger rounded-pill">{{ $galeri->likes->count() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th>Identitas</th>
                                <th>Tipe</th>
                                <th>Tanggal</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galeri->likes as $like)
                            <tr>
                                <td>
                                    @if ($like->user)
                                    <span class="fw-bold d-block text-dark">{{ $like->user->name }}</span>
                                    <small class="text-muted">{{ $like->user->email }}</small>
                                    @else 
                                    <span class="fw-bold d-block text-dark">Tamu</span>
                                    <small class="font monospace text-muted">{{ $like->ip_addres ?? 'IP Tidak Terdeteksi' }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($like->user_id)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">User</span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted d-block">{{ $like->created_at->isoFormat('DD MMMM YYYY') }}</small>
                                    <small class="text-muted opacity-75" style="font-size: 0.75rem;">{{ $like->created_at->format('H:i') }}</small>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.like.destroy', $like->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus like ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Hapus Like">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada yang menyukai pada foto ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection