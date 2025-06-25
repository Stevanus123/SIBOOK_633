<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        @yield('title')
    </title>
    <link rel="icon" href="{{ asset('logo-buku.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />


    <style>
        :root {
            --krem: #fff7d1;
            --peach: #ffecc8;
            --oranye-muda: #ffd09b;
            --pink: #fd7272;
        }

        .breadcrumb-item a {
            color: #fd7272 !important;
            font-weight: 500;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #fd7272;
            font-size: 1.1em;
        }

        .navbar-pastel {
            background-color: var(--peach);
        }

        .navbar-pastel .navbar-brand,
        .navbar-pastel .nav-link {
            color: #5c3b28;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-pastel .nav-link::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%) scaleX(0);
            transform-origin: center;
            width: 80%;
            height: 2px;
            background-color: var(--pink);
            transition: transform 0.3s ease;
        }

        .navbar-pastel .nav-link:hover {
            color: var(--pink);
        }

        .navbar-pastel .nav-link:hover::after {
            transform: translateX(-50%) scaleX(1);
        }

        .navbar-pastel .nav-link.active {
            color: var(--pink);
        }

        .navbar-pastel .nav-link.active::after {
            transform: translateX(-50%) scaleX(1);
        }

        .icon-btn {
            background: transparent;
            border: none;
            color: #5c3b28;
            font-size: 1.3rem;
            margin-left: 0.75rem;
        }

        .dropdown-menu-custom .dropdown-item-custom {
            color: #5c3b28;
            padding: 0.5rem 1.5rem;
            display: block;
            text-decoration: none;
        }

        .dropdown-menu-custom .dropdown-item-custom:hover,
        .dropdown-menu-custom .dropdown-item-custom.active {
            background: var(--peach);
            font-weight: 500;
            color: var(--pink) !important;
        }

        .kategori-grid {
            display: grid;
            grid-auto-flow: column;
            grid-template-rows: repeat(10, auto);
            gap: 3px 10px;
            white-space: nowrap;
        }

        .kategori-grid li {
            list-style: none;
        }

        .search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .search-wrapper input {
            width: 0;
            opacity: 0;
            transition: all 0.4s ease;
            border: none;
            border-radius: 2rem;
            margin-right: 2rem;
            padding: 0.4rem 1rem 0.4rem 2rem;
            font-size: 0.9rem;
            background-color: var(--krem);
            color: #5c3b28;
            outline: none;
            position: absolute;
            right: 0;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(92, 59, 40, 0.15);
        }

        .search-wrapper:hover input,
        .search-wrapper.active input,
        .search-wrapper input:not(:placeholder-shown) {
            width: 200px;
            opacity: 1;
        }

        .search-wrapper i {
            color: #5c3b28;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .search-wrapper:hover i {
            color: var(--pink);
        }

        .search-form {
            margin-bottom: 0;
            display: flex;
            align-items: center;
            position: relative;
            width: 100%;
        }

        .search-form i {
            cursor: pointer;
        }

        .footer-pastel {
            background-color: var(--oranye-muda);
            /* #FFD09B */
            color: #5c3b28;
        }

        .footer-link {
            color: #5c3b28;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover,
        .footer-link.active {
            color: var(--pink);
            /* #FFB0B0 */
            text-decoration: underline;
        }

        .footer-pastel hr {
            border-top: 1px solid var(--peach);
            /* #FFECC8 */
        }

        h6 {
            color: black;
        }

        p {
            color: black;
        }

        .book-card {
            display: block;
            width: 13.7rem;
            text-decoration: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #f4f4f4;
        }

        .book-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .book-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .book-card h6 {
            font-size: 1rem;
            font-weight: 600;
            margin: 5px 0;
        }

        .book-card p {
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="min-vh-100" style="background-color: #e7e7e7">
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <!-- header  -->
        <header class="sticky-top">
            <nav class="row navbar navbar-expand-lg navbar-pastel shadow-sm">
                <div class="container">
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="/home">
                        <img src="{{ asset('logo-buku.png') }}" alt="Logo" width="30rem"> SIBOOK
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto ms-lg-5 mb-2 mb-lg-0">
                            @if (Auth::check())
                                <li class="nav-item px-2 ">
                                    <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" href="/home">Home</a>
                                </li>
                                <li class="nav-item px-2 position-relative kategori-dropdown " id="kategoriParent">
                                    <a class="nav-link {{ $active == 'kategori' ? 'active' : '' }}"
                                        id="kategoriDropdown" style="cursor: pointer">
                                        Kategori <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu-custom kategori-grid shadow" id="kategoriDropdownMenu"
                                        style="display: none; position: absolute; left: 0; background: var(--krem); min-width: 250px; border-radius: 0.5rem; padding: 0.5rem; list-style: none;">
                                        @foreach ($cate as $c)
                                            <li>
                                                <a class="dropdown-item-custom {{ $active == 'kategori' && ucfirst($key) == $c->nama_kategori ? 'active' : '' }}"
                                                    href="/kategori/{{ strtolower($c->nama_kategori) }}">{{ $c->nama_kategori }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item px-2 ">
                                    <a class="nav-link {{ $active == 'promo' ? 'active' : '' }}"
                                        href="/promo">Promo</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link {{ $active == 'penerbitan' ? 'active' : '' }}"
                                        href="/penerbitan">Penerbitan</a>
                                </li>
                            @else
                                <li class="nav-item px-2 ">
                                    <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" href="/">Home</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="#" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                        Kategori</i>
                                    </a>
                                </li>
                                <li class="nav-item px-2 ">
                                    <a class="nav-link " data-bs-toggle="modal" data-bs-target="#loginModal"
                                        href="#">Promo</a>
                                </li>
                            @endif
                        </ul>
                        @if (Auth::check())
                            <div class="d-flex align-items-center navbar-nav mb-2 mb-lg-0 me-4">
                            @else
                                <div class="d-flex align-items-center navbar-nav mb-2 mb-lg-0 gap-4 me-4">
                        @endif
                        <div class="search-wrapper me-2 nav-link">
                            <form action="/search/{{ $active }}" method="GET" class="search-form">
                                <i class="bi bi-search"></i>
                                <input type="text" name="judul" placeholder="Cari buku..."
                                    onkeydown="if(event.key==='Enter'){ this.form.submit(); }" />
                            </form>
                        </div>
                        @if (Auth::check())
                            <a href="/cart" class="nav-link icon-btn px-3 {{ $active == 'cart' ? 'active' : '' }}"
                                aria-label="Keranjang">
                                <i class="bi bi-cart3"></i>
                            </a>
                            <a href="/profile"
                                class="nav-link icon-btn px-3 {{ $active == 'profile' ? 'active' : '' }}"
                                aria-label="Profil">
                                <i class="bi bi-person-circle"></i>
                            </a>
                        @else
                            <a href="/login"
                                class="btn btn-warning d-flex align-items-center gap-2 px-3 py-1 shadow-sm border-0 rounded fw-bolder">
                                <i class="bi bi-box-arrow-in-right fs-5"></i>
                                <span>Masuk</span>
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </header>
        <!-- Modal Login -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: var(--peach); border-radius: 1rem;">
                    <div class="modal-header border-0 pb-0">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-3"></i>
                            <h5 class="modal-title fw-bold" id="loginModalLabel" style="color: #5c3b28;">Akses Dibatasi
                            </h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mb-3" style="color: #5c3b28; font-size: 1.1rem;">
                            Untuk mengakses fitur ini, Anda harus <span class="fw-bold text-warning">login</span>
                            terlebih dahulu.
                        </p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                        <a href="/regis" class="btn fw-bold px-4 ms-2"
                            style="background-color: var(--pink); color: var(--peach);">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </a>
                        <a href="/login" class="btn btn-warning fw-bold px-4 shadow-sm" style="color: #5c3b28;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <main style="flex: 1">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    <script>
                        setTimeout(function() {
                            var alert = document.getElementById('alert-message');
                            if (alert) alert.style.display = 'none';
                        }, 3000);
                    </script>
                @endif
                {{-- content --}}
                @yield('content')
            </div>
        </main>


        <!-- footer -->
        <footer class="row footer-pastel py-4">
            <div class="container">
                <div class="row text-center text-md-start">
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold">SIBOOK</h5>
                        <p class="small">
                            Tempat terbaik untuk mencari dan menerbitkan buku-buku
                            berkualitas.
                        </p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h6 class="fw-semibold">Menu</h6>
                        <ul class="list-unstyled">
                            <li><a href="/home"
                                    class="footer-link {{ $active == 'home' ? 'active' : '' }}">Home</a>
                            </li>
                            <li><a href="/kategori"
                                    class="footer-link {{ $active == 'kategori' ? 'active' : '' }}">Kategori</a></li>
                            <li><a href="/promo"
                                    class="footer-link {{ $active == 'promo' ? 'active' : '' }}">Promo</a>
                            </li>
                            <li><a href="/penerbitan"
                                    class="footer-link {{ $active == 'penerbitan' ? 'active' : '' }}">Penerbitan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h6 class="fw-semibold">Kontak</h6>
                        <p class="small mb-1">
                            <i class="bi bi-envelope me-2"></i>support@sibook.id
                        </p>
                        <p class="small"><i class="bi bi-instagram me-2"></i>@sibook.id</p>
                    </div>
                </div>
                <hr class="my-3" />
                <div class="text-center small text-muted">
                    &copy; 2025 SIBOOK. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(input) {
            var label = document.querySelector('label[for="' + input.id + '"]');
            if (label && !label.innerHTML.includes('*')) {
                label.innerHTML += ' <span style="color:#fd7272;font-weight:bold">*</span>';
            }
        });
    </script>
    <script>
        const slides = document.querySelectorAll(".poster-carousel");
        const dotContainer = document.getElementById("dotContainer");
        let current = 0;

        // Buat dot sesuai jumlah gambar
        slides.forEach((_, i) => {
            const dot = document.createElement("div");
            dot.classList.add("dot");
            dot.addEventListener("click", () => goToSlide(i));
            dotContainer.appendChild(dot);
        });

        const dots = document.querySelectorAll(".dot");

        function showSlide(index) {
            slides.forEach((slide) => slide.classList.add("d-none"));
            slides[index].classList.remove("d-none");

            dots.forEach((dot) => dot.classList.remove("active"));
            dots[index].classList.add("active");
        }

        function nextSlide() {
            current = (current + 1) % slides.length;
            showSlide(current);
        }

        function prevSlide() {
            current = (current - 1 + slides.length) % slides.length;
            showSlide(current);
        }

        function goToSlide(index) {
            current = index;
            showSlide(current);
        }

        // Inisialisasi
        showSlide(current);

        // Otomatis ganti setiap 3 detik (opsional)
        setInterval(nextSlide, 3000);
    </script>
    <script>
        const parent = document.getElementById('kategoriParent');
        const dropdownMenu = document.getElementById('kategoriDropdownMenu');

        parent.addEventListener('mouseenter', () => {
            dropdownMenu.style.display = 'grid';
            document.getElementById('kategoriDropdown').innerHTML = 'Kategori <i class="bi bi-chevron-up"></i>';
        });

        parent.addEventListener('mouseleave', () => {
            dropdownMenu.style.display = 'none';
            document.getElementById('kategoriDropdown').innerHTML = 'Kategori <i class="bi bi-chevron-down"></i>';
        });
    </script>
</body>

</html>
