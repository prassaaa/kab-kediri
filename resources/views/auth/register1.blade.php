<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Sistem Informasi Cagar Budaya">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/kediri1.png') }}" type="image/png">
    
    <title>{{ config('app.name', 'Laravel') }} - Register</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-container {
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
        
        .notice-box {
            background-color: #e9f5fe;
            border-left: 4px solid #0d6efd;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 5px;
        }
        
        .maps-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }
        
        .maps-btn:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .maps-btn i {
            margin-right: 8px;
        }
        
        .office-info {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .office-info p {
            margin-bottom: 8px;
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
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center mb-4">
                    <div class="d-flex justify-content-center align-items-center logo-wrapper">
                        <img src="{{ asset('assets/img/kediri2.png') }}" alt="Logo Disparbud" class="img-fluid logo-image me-3" style="max-height: 100px;">
                        <div class="logo-text text-start">
                            <h3 class="fw-bold mb-1">Sistem Informasi</h3>
                            <h4 class="text-muted">Warisan Budaya Kabupaten Kediri</h4>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Pendaftaran Belum Tersedia</h1>
                        
                        <div class="notice-box">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Pendaftaran</h5>
                            <p>Mohon maaf, pendaftaran online saat ini belum tersedia. Untuk mendaftar, silakan kunjungi kantor kami:</p>
                            
                            <div class="office-info">
                                <p><strong>Dinas Pariwisata dan Kebudayaan Kabupaten Kediri</strong></p>
                                <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Erlangga No.1, Ngadirejo, Kec. Kota, Kota Kediri, Jawa Timur 64129</p>
                                <p><i class="fas fa-clock me-2"></i>Senin - Jumat: 08.00 - 16.00 WIB</p>
                            </div>
                            
                            <div class="text-center">
                                <a href="https://maps.app.goo.gl/JeoM4xhSQnkgoVdeA" target="_blank" class="btn maps-btn">
                                    <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                                </a>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p>Terima kasih atas minat Anda untuk bergabung dengan sistem kami.</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Kembali ke Halaman Login</a>
                        </div>
                    </div>
                </div>
                <div class="text-center footer-text">
                    Copyright &copy; {{ date('Y') }} &mdash; Dinas Pariwisata dan Kebudayaan Kabupaten Kediri Bidang Jakala
                </div>
            </div>
        </div>
    </div>
</body>
</html>