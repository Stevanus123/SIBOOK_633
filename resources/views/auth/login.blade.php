<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SIBOOK | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('logo-buku.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: blanchedalmond;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn {
            background-color: blanchedalmond;
        }

        .btn:hover {
            background-color: rgb(255, 226, 183);

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
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 bg-light shadow">
                    {{-- Alert for login success --}}
                    @if (session('alert'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="login-alert">
                            <strong>{{ session('alert') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            setTimeout(function() {
                                var alert = document.getElementById('login-alert');
                                if (alert) {
                                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                                    bsAlert.close();
                                }
                            }, 3000);
                        </script>
                    @endif
                    <h3 class="text-center mb-4">Login</h3>
                    <form action="/ceklogin" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn" type="button" id="togglePassword" tabindex="-1">
                                    <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                </button>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const passwordInput = document.getElementById('password');
                                    const togglePassword = document.getElementById('togglePassword');
                                    const eyeIcon = document.getElementById('eyeIcon');
                                    togglePassword.addEventListener('click', function () {
                                        const type = passwordInput.type === 'password' ? 'text' : 'password';
                                        passwordInput.type = type;
                                        eyeIcon.classList.toggle('bi-eye-fill');
                                        eyeIcon.classList.toggle('bi-eye-slash-fill');
                                    });
                                });
                            </script>
                        </div>

                        <button type="submit" class="btn w-100 fw-bold" style="color: #9d654a;">Login</button>
                    </form>
                    <div class="regis text-center border-top mt-3 pt-2">
                        <p style="color: #9d654a;">Belum punya akun? <a href="/regis">Daftar disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>