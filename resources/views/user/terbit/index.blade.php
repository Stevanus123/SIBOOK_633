@extends('layouts.main')
@section('title', 'SIBOOK | Penerbitan Buku')
@section('content')
	<!-- tampilan ajakan input buku -->
	<div class="row my-3 border bg-white shadow-sm" style="border-radius: 10px">
		<!-- ajakan penerbitan -->
		<div class="py-5">
			<div class="container text-center">
				<p class="fw-bold fs-5">
					<span>Sudah Terbukti,</span> Ribuan Penulis Telah Kami Terbitkan
					Naskah Bukunya Hanya Dalam Waktu 6 Minggu!
				</p>
				<h1 class="fw-bold text-dark display-5 mb-3">
					Terbitkan Disini<br />Mudah, Cepat dan Murah!
				</h1>
				<p>Jangan lewatkan kesempatan ini!</p>
				<div class="d-flex justify-content-center">
					<a href="/terbit/insert" class="btn btn-primary btn-lg fw-bold px-4">
						<i class="bi bi-stars me-2"></i>Terbitkan Sekarang
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- testimoni -->
	<div class="row my-3 py-5 bg-white shadow-sm" style="border-radius: 10px">
		<div class="col text-center">
			<h6 class="fw-bold">Testimoni</h6>
			<h1 class="fw-bold display-5 mb-3">Apa Kata Mereka?</h1>

			<div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
				<div class="carousel-inner">
					<!-- Slide 1 -->
					<div class="carousel-item active">
						<div class="card mx-auto border-0" style="width: 60rem;">
							<div class="card-header d-flex align-items-center my-2">
								<img src="icon/orang-1.jpeg" class="border rounded-circle me-4" width="10%" />
								<div class="text-start">
									<p class="fw-bold mb-0 fs-5">Gatot Subroto Simbolon</p>
									<p class="mb-0" style="font-size: medium">
										Presiden Stargazer
									</p>
								</div>
							</div>
							<div class="card-body d-flex justify-content-center">
								<p class="card-text fst-italic" style="text-align: justify; width: 80%">
									"Keren sih yang buat website penjualan buku ini. Desain ramah di mata juga harganya ramah di kantong!"
								</p>
							</div>
						</div>
					</div>

					<!-- Slide 2 -->
					<div class="carousel-item">
						<div class="card mx-auto border-0" style="width: 60rem">
							<div class="card-header d-flex align-items-center my-2">
								<img src="icon/orang-2.jpg" class="border rounded-circle me-4" width="10%" />
								<div class="text-start">
									<p class="fw-bold mb-0 fs-5">Dave Aryanda Agape</p>
									<p class="mb-0" style="font-size: medium">
										Presiden Astro Power
									</p>
								</div>
							</div>
							<div class="card-body d-flex justify-content-center">
								<p class="card-text fst-italic" style="text-align: justify; width: 80%">
									"Ga nyangka bisa sekeren ini! Sangat interaktif dan seperti penjualan secara nyata."
								</p>
							</div>
						</div>
					</div>

					<!-- Slide 3 -->
					<div class="carousel-item">
						<div class="card mx-auto border-0" style="width: 60rem">
							<div class="card-header d-flex align-items-center my-2">
								<img src="icon/orang-3.jpeg" class="border rounded-circle me-4" width="10%" />
								<div class="text-start">
									<p class="fw-bold mb-0 fs-5">Hans Gunawan</p>
									<p class="mb-0" style="font-size: medium">
										Ketua Coding Informatika
									</p>
								</div>
							</div>
							<div class="card-body d-flex justify-content-center">
								<p class="card-text fst-italic" style="text-align: justify; width: 80%">
									"Iri banget liat desain dan proses bisnis yang sangat kompleks dan nyata seperti ini!"
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Panah Navigasi -->
				<button class="carousel-control-prev btn btn-outline-dark ms-3 mt-5" type="button"
					data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width: 2em; height: 2em;">
					<span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next btn btn-outline-dark me-3 mt-5" type="button"
					data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width: 2em; height: 2em;">
					<span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>
	</div>
@endsection