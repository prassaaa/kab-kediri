<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kediri Berbudaya</title>
        <link rel="icon" type="image/x-icon" href="https://kediritourism.kedirikota.go.id/wp-content/uploads/2021/06/cropped-logo-pemkot-192x192.png" />
        <!-- Font Awesome icons -->
        <script src="https://kit.fontawesome.com/5e27e077c6.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <style>
            .logo-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                margin-top: -100px;
            }
            .logo-item {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0 15px;
            }
            
            .logo-berbudaya img {
                width: 75px;
                height: 120px;
                object-fit: contain;
            }
            .logo-ornamen img {
                width: 110px;
                height: 180px;
                object-fit: contain;
            }
            .logo-kediri img {
                width: 150px;
                height: 180px;
                object-fit: contain;
                background-color: transparent;
            }
        </style>
    </head>
    <body>
        <!-- Background Video-->
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="{{ asset('assets/mp4/bg.mp4') }}" type="video/mp4" /></video>
        <!-- Masthead-->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <div class="logo-row">
                        <div class="logo-item logo-berbudaya">
                            <img src="{{ asset('assets/img/kediri1.png') }}" alt="Kediri Berbudaya" />
                        </div>
                        <div class="logo-item logo-ornamen">
                            <img src="{{ asset('assets/img/kediri2.png') }}" alt="Logo Cagar Budaya" />
                        </div>
                        <div class="logo-item logo-kediri">
                            <img src="{{ asset('assets/img/kediri3.png') }}" alt="Lambang Disparbud" />
                        </div>
                    </div>
                    
                    <h1 class="fst-italic lh-1 mb-4">Our Website is Coming Soon</h1>
                    <p class="mb-5">We're working hard to finish the development of this site. Sign up below to receive updates and to be notified when we launch!</p>
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="email" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Notify Me!</button></div>
                        </div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="email:email">Email is not valid.</div>
                        <!-- Submit success message-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3 mt-2">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Social Icons-->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="https://www.instagram.com/budayakediri/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>