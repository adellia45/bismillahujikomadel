<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMKN 4 Bogor')</title>

    <!--bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        /*sidebar styling*/
        .sidebar{
            width: 260px;
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar .nav-link{
            color: #495057;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active{
            background-color: #0d6efd;
            color: #ffffff;
        }
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 2rem
        }

    </style>
</head>
<body>
    <div class="d-flex">
    <!--sidebae navbar-->
    <aside class="sidebar p-3 d-flex flex-column justify-content-between">
        <div>
            <div class="d-flex align-items-center gap-2 px-2 py-3 mb-3 border-bottom">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo SMKN 4 Bogor" style="height: 40px; width: auto;">
                <h5 class="fw-bold mb-0 text-dark">SI-Kr4bat</h5>
            </div>

            <!--navigasi-->
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dasbor</span>
                </a>
                <a class="nav-link {{ request()->is('admin/program*') ? 'active' : ''}}" href="{{ route('admin.program.index') }}">
                    <i class="bi bi-award-fill"></i>
                    <span>Program Keahlian</span>
                </a>
                <a class="nav-link {{ request()->is('admin/galeri*') ? 'active' : ''}}" href="{{ route('admin.galeri.index') }}">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
                <a class="nav-link {{ request()->is('admin/artikel*') ? 'active' : ''}}" href="{{ route('admin.artikel.index') }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Artikel</span>
                </a>
                <a class="nav-link text-primary mt-2" href="{{ url('/') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Lihat Website</span>
                </a>
            </nav>
        </div>
        <!--tombolkeluar-->
        <div class="pt-3 border-top">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-danger w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

    </div>

    <!--bootstrap 5 js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>