<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts (Pastikan font 'Source Sans 3' terimport) -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans 3', sans-serif; /* Font */
            font-size: 14px; /* Ukuran font */
            color: #484444
        }
    </style>
        @favicon
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #f0f8ff; margin: 0;">
    <div class="w-100" style="max-width: 400px;">
        <!-- Error Message -->
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; padding: 15px 20px;">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Error</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Login Container -->
        <div class=" text-center p-4" style="background-color: #E7FAFf; border-radius: 23px; box-shadow: 0px 0px 30px rgba(0, 111, 255, 0.35);">
            <h1 class="fs-4 fw-bold mb-3" style="color: #484444">LOGIN</h1>
            <img src="/vendor/adminlte/dist/img/app-logo-color.png" alt="Logo" class="mb-3" style="width: 100px; border-radius: 50%; box-shadow: 0px 0px 15px rgb(21, 138, 167);">
            <p class="text-muted mb-3 ">Pelanggaran Mahasiswa IT Del</p>
            <hr style="border-top: 2px solid #B9BBDC;" class="mx-auto" style="width: 100%;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username Field -->
                <div class="mb-3 text-start">
                    <label for="username" class="form-label fw-bold">Username :</label>
                    <input type="text" name="username" id="username" class="form-control" required
                           style="border-radius: 7px; background-color:rgb(205, 229, 238); border: 2px solid #B9BBDC; padding: 6px;">
                </div>
                <!-- Password Field -->
                <div class="mb-3 text-start">
                    <label for="password" class="form-label fw-bold">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" required
                           style="border-radius: 7px; background-color:rgb(205, 229, 238); border: 2px solid #B9BBDC; padding: 6px;">
                </div>
                <!-- Remember Me Checkbox -->
                <div class="form-check mb-3 text-start">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                           style="border: 2px solid #B9BBDC;">
                    <label class="form-check-label fs-7 text-dark" for="remember">Remember Me</label>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn text-white fw-bold"
                            style="background-color: #5AADC2; border-radius: 7px; border: none; padding: 7px; width: 60%; font-size: 16px; margin-top: 20px;"
                            onmouseover="this.style.backgroundColor='#4F9CAF'"
                            onmouseout="this.style.backgroundColor='#5AADC2'">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (Untuk komponen interaktif) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
