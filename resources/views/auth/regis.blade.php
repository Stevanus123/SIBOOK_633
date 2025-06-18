<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIBOOK | Registrasi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: blanchedalmond;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      border-radius: 1rem;
    }

    .form-label {
      font-weight: 600;
      color: #C48A6C;
    }

    h3 {
      color: #C48A6C;
      font-weight: bold;
    }

    .btn {
      background-color: blanchedalmond;
    }

    .btn:hover {
      background-color: rgb(255, 226, 183);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-4 bg-light shadow">
          <h3 class="text-center mb-4">Registrasi</h3>
          <form action="/prosesRegis" method="POST">
            @csrf
            <div class="step step-1">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com"
                  required>
              </div>
              <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="tel" name="no_telp" class="form-control" id="no_telp" required>
              </div>
              <div class="mb-3">
                <label for="kota" class="form-label">Kota Sekarang</label>
                <input type="text" name="kota" class="form-control" id="kota" required>
              </div>
              <div class="d-flex justify-content-between">
                <a class="btn fw-bold" style="color: #9d654a; width: 160px;" href="/">
                  <i class="bi bi-arrow-left-circle-fill"></i> Kembali
                </a>
                <button type="button" class="btn fw-bold" style="color: #9d654a; width: 160px;" id="nextStep">Lanjut
                  <i class="bi bi-arrow-right-circle-fill"></i>
                </button>
              </div>
            </div>


            <div class="step step-2" style="display: none">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control password-field" id="password" name="password" required />
                  <button class="btn toggle-password" type="button" data-target="password" tabindex="-1">
                    <i class="bi bi-eye-fill"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control password-field" id="confirmPassword"
                    oninput="validatePassword()" required />
                  <button class="btn toggle-password" type="button" data-target="confirmPassword" tabindex="-1">
                    <i class="bi bi-eye-fill"></i>
                  </button>
                </div>
                <p class="text-danger d-none" id="konPass">Password tidak cocok!</p>
              </div>

              <div class="d-flex justify-content-between">
                <button type="button" class="btn fw-bold" style="color: #9d654a; width: 160px;" onclick="backStep()">
                  <i class="bi bi-arrow-left-circle-fill"></i> Kembali
                </button>
                <button type="submit" class="btn fw-bold" style="color: #9d654a; width: 160px;">
                  Daftar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('nextStep').addEventListener('click', function () {
    const step1Inputs = document.querySelectorAll('.step-1 input[required]');
    let allFilled = true;

    step1Inputs.forEach(input => {
      if (!input.value.trim()) {
        input.classList.add('is-invalid');
        allFilled = false;
      } else {
        input.classList.remove('is-invalid');
      }
    });

    if (allFilled) {
      document.querySelector('.step-1').style.display = 'none';
      document.querySelector('.step-2').style.display = 'block';
    }
  });
    function backStep() {
      document.querySelector('.step-1').style.display = 'block';
      document.querySelector('.step-2').style.display = 'none';
    }

    // membandingkan password
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;

      if (password !== confirmPassword) {
        document.getElementById("konPass").classList.remove("d-none");
        return false;
      }
      else {
        document.getElementById("konPass").classList.add("d-none");
        return true;
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      const toggleButtons = document.querySelectorAll('.toggle-password');

      toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
          const targetId = this.getAttribute('data-target');
          const passwordInput = document.getElementById(targetId);
          const icon = this.querySelector('i');

          // Toggle password visibility
          const type = passwordInput.type === 'password' ? 'text' : 'password';
          passwordInput.type = type;

          // Toggle eye icon
          icon.classList.toggle('bi-eye-fill');
          icon.classList.toggle('bi-eye-slash-fill');
        });
      });
    });
  </script>
</body>

</html>