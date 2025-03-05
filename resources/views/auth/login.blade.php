<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Sistem Informasi Cagar Budaya">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            padding: 15px;
            width: 100%;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }
        
        .logo-image {
            transition: all 0.3s ease;
        }
        
        .logo-text h3 {
            font-size: 1.5rem;
            color: #333;
        }
        
        .logo-text h4 {
            font-size: 1.2rem;
        }
        
        .footer-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logo-image {
                max-height: 80px !important;
            }
            
            .logo-text h3 {
                font-size: 1.3rem;
            }
            
            .logo-text h4 {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .card-body {
                padding: 20px !important;
            }
            
            .btn-primary {
                width: 100%;
                margin-top: 15px;
            }
            
            .d-flex.align-items-center {
                flex-direction: column;
            }
            
            .form-check {
                margin-bottom: 15px;
                align-self: flex-start;
            }
            
            .logo-wrapper {
                flex-direction: column;
                text-align: center;
            }
            
            .logo-image {
                max-height: 70px !important;
                margin-bottom: 10px;
                margin-right: 0 !important;
            }
            
            .logo-text {
                text-align: center !important;
            }
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center mb-4">
                    <div class="d-flex justify-content-center align-items-center logo-wrapper">
                        <img src="{{ asset('assets/img/kediri2.png') }}" alt="Logo Disparbud" class="img-fluid logo-image me-3" style="max-height: 100px;">
                        <div class="logo-text text-start">
                            <h3 class="fw-bold mb-1">Sistem Informasi</h3>
                            <h4 class="text-muted">Cagar Budaya Kabupaten Kediri</h4>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                        
                        <!-- Menampilkan error validasi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Menampilkan status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-3 rounded-0" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate autocomplete="off">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="mb-2 w-100 d-flex justify-content-between flex-wrap">
                                    <label class="text-muted" for="password">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                                            Forgot Password?
                                        </a>
                                    @endif
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="form-check-label">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Create One</a>
                        </div>
                    </div>
                </div>
                <div class="text-center footer-text">
                    Copyright &copy; {{ date('Y') }} &mdash; Dinas Pariwisata dan Kebudayaan Kabupaten Kediri Bidang Jakala
                </div>
            </div>
        </div>
    </div>
    
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>