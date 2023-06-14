<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Vendor CSS Files -->
    <link href="asset/vendor/aos/aos.css" rel="stylesheet">
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="asset/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="asset/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="asset/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="asset/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
    <div class="text">
        <p>Layanan BK</p>
    </div>
    <form action="{{route('postlogin')}}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="wrapper2 mb-4">
                        <div class="log">
                            <div class="text-hero mt-4">
                                <p>Login</p>
                            </div>

                        </div>
                        <div class="input mt-2">
                            <p>Email</p>
                            <input id="user" type="text" class="input" placeholder="Please enter your email"
                                name="email" value="{{ old('email') }}">

                            <span style="color: red">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>
                        <div class="input mt-2">
                            <p>Password</p>
                            <input id="pass" type="password" class="input" data-type="password" name="password"
                                placeholder="Please enter your password" value="{{ old('password') }}">
                            <span style="color: red">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="showPassword" name="showPassword">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger" style="color: white; height: 30px; display: flex; align-items: center; justify-content: center;">
                          @if (session('error') === 'Password salah.')
                            Password Salah.
                          @else
                            Email Salah.
                          @endif
                        </div>
                      @endif
                        <div class="line">
                            <div class="garis"></div>
                            <div class="text-line">
                                <p>atau daftar dengan</p>
                            </div>
                            <div class="garis"></div>
                        </div>
                        <div class="log">
                            <button class="google">
                                <img src="img/google.png" alt="">
                                <a href="">Google</a>
                            </button>
                        </div>
                        <div class="login mt-4">
                            <button type="submit" id="login" class="button">Login</button>
                        </div>
					</div>
    </form>
    </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="img/hero-img.png" class="img-fluid animated" alt="">
    </div>
    </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="asset/vendor/aos/aos.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="asset/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="asset/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="asset/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="asset/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="asset/js/main.js"></script>
    <script>
        const showPasswordCheckbox = document.getElementById('showPassword');
        const passwordInput = document.getElementById('password');
    
        showPasswordCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
      </script>
</body>

</html>
