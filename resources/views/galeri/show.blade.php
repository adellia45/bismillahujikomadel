@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="row g-0">
                    <!--foto-->
                    <div class="col-md-7 bg-dark d-flex align-items-center justify-content-center" style="min-height: 400px;">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" class="img-fluid w-100 object-fit-contain" alt="{{ $galeri->judul }}" style="max-height: 600px;">
                    </div>

                    <!--detail, like n komen-->
                    <div class="col-md-5 d-flex flex-column bg-white">
                        <!--detail foto-->
                        <div class="p-3 border-bottom">
                            <h5 class="fw-bold mb-1 text-dark">{{ $galeri->judul }}</h5>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($galeri->created_at)->isoFormat('D MMMM YYYY') }}
                            </small>
                            @if ($galeri->deskripsi)
                            <p class="text-secondary small mb-0">{{ $galeri->deskripsi }}</p>
                            @endif
                        </div>

                        <!--tombol like-->
                        <div class="px-3 py-2 border-bottom bg-light d-flex align-items-center justify-content-between">
                            <form action="{{ route('galeri.like', $galeri->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm text-danger border-0 p-0 fw-semibold d-flex align-items-center gap-2 shadow-none">
                                    @if ($galeri->isLikedByGuest(request()->ip()))
                                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                    @else
                                    <i class="bi bi-heart- fs-4 text-secondary"></i>
                                    @endif
                                    <span class="text-dark fs-6">{{ $galeri->likes->count() }} Suka</span>
                                </button>
                            </form>
                            <span class="text-muted small">
                                <i class="bi bi-chat-left-text me-1"></i> {{ $galeri->comments->count() }} Komentar
                            </span>
                        </div>

                        <!--komen-->
                        <div class="p-3 flex-grow-1 overflow-auto" style="max-height: 320px;">
                            @forelse($galeri->comments as $comment)
                            <div class="d-flex justify-content-between align-items-start mb-3 pb-2 border-bottom">
                                <div class="me-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold small text-dark">{{ $comment->nama_pengirim}}</span>
                                        <span class="text-muted opacity-75" style="font-size: 0.75rem;">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-secondary small mb-0 mt-1" style="word-break: break-word;">
                                        {{ $comment->isi_komentar }}
                                    </p>
                                </div>

                                <!--hapus (tapi cuman puaya diri sendiri)-->
                                @if(in_array($comment->id, session()->get('my_comments', [])))
                                <form action="{{ route('galeri.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 border-0 shadow-none text-decoration-none" title="Hapus Komentar">
                                        <i class="bi bi-trash small"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-chat-square-dots fs-3  d-block ,b-1 opacity-50"></i>
                                <small>Belum ada komentar, jadilah yang pertama!</small>
                            </div>
                            @endforelse
                        </div>
                        <!--form input komen-->
                        <div class="p-3 border-top bg-white">
                            <form action="{{ route('galeri.comment.store', $galeri->id) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <input type="text" name="nama_pengirim" class="form-control form-control-sm bg-white" placeholder="Nama Kamu.." required maxlength="50" value="{{ old('nama_pengirim') }}">
                                </div>
                                <div class="input-group">
                                    <input type="text" name="isi_komentar" class="form-control form-control-sm bg-white" placeholder="Tulis komentar.." required maxlength="500">
                                    <button class="btn btn-primary btn-sm fw-semibold" type="submit">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection