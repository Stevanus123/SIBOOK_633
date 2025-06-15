<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="icon" href="{{ asset('logo-buku.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: blanchedalmond;
            color: black;
            flex-shrink: 0;
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 15px;
        }

        .sidebar a:hover {
            background-color: rgb(255, 218, 164);
            font-weight: 600;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    {{-- navbar active belum ditambahin --}}
    <div class="sidebar d-flex flex-column">
        <h4 class="text-center mt-3">📚 SiBook Admin</h4>
        <hr>
        <a href="/admin/buku">📖 Kelola Buku</a>
        <a href="/admin/kategori">🏷️ Kategori</a>
        <a href="/admin/diskon">🎁 Diskon</a>
        <a href="/admin/user">👥 Pengguna</a>
        <a href="/admin/saldo">💰 Saldo</a>
        <a href="/admin/terbit">➕ Penerbitan</a>
        <a href="/admin/order">🛒 Pesanan</a>
        <a href="/logout" class="mt-auto mb-3">🚪 Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">@yield('judKonten')</span>
            </div>
        </nav>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function () {
                    var alert = document.getElementById('alert-message');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function () {
                    var alert = document.getElementById('alert-message');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif
        <!-- Navbar -->
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>