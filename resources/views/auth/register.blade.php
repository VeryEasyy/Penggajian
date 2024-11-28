<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin">
                <form action="/auth/register" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                        <label for="nuptk">Email</label>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                        <label for="password_confirmation">Konfirmasi Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3">Sudah punya akun? <a href="/">Login</a></small>
            </main>
        </div>
    </div>
</body>
</html>
