<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @yield('title')
  <link rel="icon" href="{{ asset('logo-buku.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    .container-fluid {
      flex: 1 0 auto;
      display: flex;
      flex-direction: column;
    }

    .row:last-child {
      margin-top: auto;
    }

    .nav-link {
      color: black;
    }

    h6 {
      color: black;
    }

    p {
      color: black;
    }

    .nav-link:hover,
    .nav-link:focus,
    .nav-link.active {
      color: black;
      background-color: white;
    }

    .search:hover,
    .search:focus-within {
      background-color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease;
    }

    input:focus {
      outline: none;
      box-shadow: none;
    }

  </style>
</head>

<body class="min-vh-100 d-flex flex-column">
  <div class="container-fluid">
    <!-- header  -->
    <div class="row sticky-top" style="background-color: blanchedalmond">
      <div class="col d-flex justify-content-evenly align-items-center">
        <a class="nav-link" href="/home">
          <img src="{{ asset('logo-buku.png') }}" alt="Logo" width="20em" /> Sistem
          Informasi Buku</a>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link {{ ($active == 'home') ? 'active' : '' }}" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
              aria-expanded="false">Kategori</a>
            <ul class="dropdown-menu">
              @foreach ($cate as $c)
          <li>
          <a class="dropdown-item"
            href="/kategori/{{ strtolower($c->nama_kategori) }}">{{ ucfirst($c->nama_kategori) }}</a>
          </li>
        @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == 'promo') ? 'active' : '' }}" href="/promo">Promo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == 'penerbitan') ? 'active' : '' }}" href="/penerbitan">Penerbitan</a>
          </li>
        </ul>

        <!-- pencarian -->
        <form method="get" action="/{{ $active}}{{ isset($key)?'-'.$key : '' }}/search" class="mb-0">
          <div class="d-flex align-items-center border border-dark rounded-pill px-3 py-1 search">
            <div class="d-flex align-items-center px-2">
              <i class="bi bi-search"></i>
            </div>
            <input type="text" class="border-0" placeholder="Cari buku...."
              style="flex: 1; background-color: transparent" name="judul" />
          </div>
        </form>

        <!-- icon user dan cart -->
        <div class="d-flex align-items-center">
          <a href="/cart" class="nav-link {{ ($active == 'cart') ? 'active' : '' }}">
            <img src="{{ asset('icon/cart-icon.png') }}" alt="Cart" width="20em" />
          </a>
          <a href="/profile" class="nav-link {{ ($active == 'profile') ? 'active' : '' }}">
            <img src="{{ asset('icon/user-icon.png') }}" alt="User" width="25em" />
          </a>
        </div>
      </div>
    </div>


    {{-- content --}}
    @yield('content')

    <!-- footer -->
    <div class="row" style="background-color: blanchedalmond">
      <div class="col-12">
        <footer class="text-center pt-3">
          <p>
            &copy; 2025 Sistem Informasi Buku - Stevanus Denko F.A. All rights
            reserved.
          </p>
        </footer>
      </div>
    </div>
  </div>

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
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
</body>

</html>