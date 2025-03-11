<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cagar Budaya Kabupaten Kediri</title>
    <link rel="icon" href="{{ asset('assets/img/kediri1.png') }}" type="image/png">
    <style>
        :root {
            --orange-primary: #FF7700;
            --orange-secondary: #FF9D45;
            --white: #FFFFFF;
            --light-gray: #F5F5F5;
            --dark-gray: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--white);
            color: var(--dark-gray);
        }
        
        header {
            background-color: var(--white);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 60px;
            margin-right: 1rem;
        }
        
        .logo-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--dark-gray);
            line-height: 1.2;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin: 0 1rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--dark-gray);
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--orange-primary);
        }
        
        .login-btn {
            background-color: var(--orange-primary);
            color: var(--white) !important;
            padding: 0.5rem 1.5rem !important;
            border-radius: 5px;
            transition: background-color 0.3s !important;
        }
        
        .login-btn:hover {
            background-color: var(--orange-secondary);
        }
        
        /* Hamburger menu styles */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            cursor: pointer;
        }
        
        .hamburger span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: var(--dark-gray);
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .hero {
            padding-top: 120px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            padding: 0 2rem;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--dark-gray);
        }
        
        .hero h1 span {
            color: var(--orange-primary);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: var(--dark-gray);
        }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: var(--orange-primary);
            color: var(--white);
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--orange-secondary);
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        footer {
            background-color: var(--dark-gray);
            color: var(--white);
            padding: 3rem 10% 2rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--orange-primary);
        }
        
        .footer-column p {
            margin-bottom: 1rem;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 0.8rem;
        }
        
        .footer-column ul li a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: var(--orange-primary);
        }
        
        .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .contact-info i {
            margin-right: 0.8rem;
            color: var(--orange-primary);
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .hamburger {
                display: flex;
                z-index: 101;
            }
            
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 70%;
                height: 100vh;
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                justify-content: center;
                box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
                transition: right 0.3s ease;
                z-index: 100;
            }
            
            .nav-links.active {
                right: 0;
            }
            
            .nav-links li {
                margin: 1.5rem 0;
            }
            
            .hamburger.active span:nth-child(1) {
                transform: translateY(9px) rotate(45deg);
            }
            
            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger.active span:nth-child(3) {
                transform: translateY(-9px) rotate(-45deg);
            }
            
            .hero {
                padding-top: 150px;
                height: auto;
                min-height: 100vh;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .cta-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('assets/img/kediri1.png') }}" alt="Logo Kabupaten Kediri">
                <div class="logo-text">
                    Dinas Pariwisata Dan Kebudayaan<br>Kabupaten Kediri
                </div>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ route('login') }}" class="login-btn">LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Sistem Informasi <span>Warisan Budaya</span> Kabupaten Kediri</h1>
                <p>Melestarikan warisan budaya lokal melalui dokumentasi digital yang komprehensif dan terpadu untuk generasi masa kini dan masa depan.</p>
                <div class="cta-buttons">
                    <a href="#" class="btn">Jelajahi Cagar Budaya</a>
                    <a href="#" class="btn">Peta Lokasi</a>
                    <a href="#" class="btn">Dokumentasi Digital</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Tentang Kami</h3>
                <p>Sistem Informasi Cagar Budaya Kabupaten Kediri merupakan inisiatif Dinas Pariwisata Dan Kebudayaan untuk melestarikan dan mempromosikan warisan budaya lokal.</p>
                <p>Sistem ini bertujuan untuk mendokumentasikan, mengedukasi, dan menginspirasi masyarakat tentang kekayaan budaya Kabupaten Kediri.</p>
            </div>
            <div class="footer-column">
                <h3>Sosial Media</h3>
                <ul>
                    <li><a href="https://www.instagram.com/kabupatenkediriku">Instagram</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Hubungi Kami</h3>
                <div class="contact-info">
                    <i>📍</i>
                    <p>Jl. Erlangga No.1, Ngadirejo, Kec. Kota, Kota Kediri, Jawa Timur 64129</p>
                </div>
                <div class="contact-info">
                    <i>📞</i>
                    <p>(0354) 691776</p>
                </div>
                <div class="contact-info">
                    <i>✉️</i>
                    <p>disbudparbud@kedirikab.go.id</p>
                </div>
                <div class="contact-info">
                    <i>🌐</i>
                    <p>www.kedirikab.go.id</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© 2025 Dinas Pariwisata Dan Kebudayaan Kabupaten Kediri. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        // JavaScript for hamburger menu toggle
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Close menu when a link is clicked
        document.querySelectorAll('.nav-links li a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });
    </script>
</body>
</html>