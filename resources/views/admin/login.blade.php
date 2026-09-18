<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMKN 4 Bogor</title>
    <!--bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--bootstrap ikon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            /*background foto*/
            background: linear-gradient(rgba(13, 110, 253, 0.75), rgba(13, 110,253, 0.75)), url('{{asset("img/smkn4bogor.jpg")}}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card{
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card login-card shadow-lg border-0 mx-auto overflow-hidden">
                    <div class="card-body p-4 p-sm-5">

                    <!--header-->
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                        <img src="{{asset('img/logo.jpg')}}" alt="Logo SMKN 4 Bogor" style="height: 48px; width: auto;">
                        <h4 class="fw-bold mb-0 text-dark">SI-Kr4bat</h4>
                    </div>

                    <!--sub judul-->
                    <p class="text-center text-secondary fw-semibold small mb-4">Admin Panel</p>

                    <!--kalo semisal error-->
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                        {{session('error')}}
                        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!--form login-->
                    <form action="{{route('login.post')}}" method="Post">
                        @csrf
                        <!--bagian nama pengguna-->
                        <div class="mb-3">
                            <label for="username" class="form-label d-block text-dark fw-medium small mb-1">Nama Pengguna</label>
                            <input type="text"
                            name="username"
                            id="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username')}}"
                            placeholder="Masukkan nama pengguna"
                            required
                            autofocus>
                            @error('username')
                            <div class="invalid-feedback small">{{$message}}</div>
                            @enderror
                        </div>
                        <!--bagain password-->
                        <div class="mb-4">
                            <label for="password" class="form-label d-block text-dark fw-medium small mb-1">Kata Sandi</label>
                            <input type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan kata sandi"
                            required>
                            @error('password')
                            <div class="invalid-feedback small">{{$message}}</div>
                            @enderror
                        </div>
                        <!--tombol masuk-->
                        <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                            Masuk
                        </button>

                        <!--kembali ke beranda-->
                        <div class="text-center mt-3">
                            <a href="{{ url('/') }}" class="text-decoration-none small text-secondary hover-primary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda </a>
                        </div>

                        </form>
                        <!--footer-->
                        <div class="text-center mt-4 pt-2 border-top">
                            <p class="text-muted small mb-0">&copy; 2026 SMKN 4 Bogor. Hak cipta dilindungi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>