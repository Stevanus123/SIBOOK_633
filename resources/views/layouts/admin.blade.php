<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('logo-buku.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --krem: #fff7d1;
            --peach: #ffecc8;
            --oranye-muda: #ffd09b;
            --pink: #fd7272;
        }

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

        .sidebar a:hover,
        .sidebar a.active {
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
    <div class="sidebar d-flex flex-column"
        style="position: fixed; height:100vh; width:17rem; z-index: 1; overflow-y: auto;">
        <h4 class="text-center mt-3">📚 SiBook Admin</h4>
        <hr>
        <a href="/admin/buku" class="{{ $active == 'buku' ? 'active' : '' }}">📖 Kelola Buku</a>
        <a href="/admin/kategori" class="{{ $active == 'kategori' ? 'active' : '' }}">🏷️ Kategori</a>
        <a href="/admin/diskon" class="{{ $active == 'diskon' ? 'active' : '' }}">🎁 Diskon</a>
        <a href="/admin/user" class="{{ $active == 'pengguna' ? 'active' : '' }}">👥 Pengguna</a>
        <a href="/admin/saldo" class="{{ $active == 'saldo' ? 'active' : '' }}">💰 Saldo</a>
        <a href="/admin/terbit" class="{{ $active == 'terbit' ? 'active' : '' }}">➕ Penerbitan</a>
        <a href="/admin/order" class="{{ $active == 'pesanan' ? 'active' : '' }}">🛒 Pesanan</a>
        <a href="/logout" class="mt-auto mb-3">🚪 Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content " style="margin-left: 17rem">
        <nav class="navbar navbar-expand navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid">
                <h1>@yield('judKonten')</h1>
            </div>
        </nav>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('alert-message');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('alert-message');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif
        <!-- Navbar -->
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(input) {
            var label = document.querySelector('label[for="' + input.id + '"]');
            if (label && !label.innerHTML.includes('*')) {
                label.innerHTML += ' <span style="color:#fd7272;font-weight:bold">*</span>';
            }
        });
    </script>
</body>

</html>
