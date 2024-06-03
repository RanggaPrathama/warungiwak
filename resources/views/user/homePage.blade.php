<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jomolhari&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="home">

    <nav class="navbar">
        <div class="navbar-left">
            <img class="image" src="images/iwakcok.svg" alt="">
            <p style="font-family: Big Shoulders Text; color:#fff; font-size: 40px; margin: 0; font-weight: 600;">WARUNG IWAK</p>
        </div>
        <div class="navbar-right">

            <a class="link" href="{{route('homeUser')}}">Home</a>
            <a class="link" href="{{route('homeUser')}}">Menu</a>
            <a class="link" href="{{route('homeUser')}}">Pesan</a>
            <a class="link" id="loginLink" href="javascript:void(0);">Login</a>
        </div>
    </nav>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <section class="about row d-flex justify-content-between">
        <div class="col-8 d-flex flex-column justify-content-between p-5">
            <p class="desk">Warung iwak adalah tempat makan sederhana yang menyajikan hidangan lezat dengan fokus pada ikan segar dan memiliki sausana yang nyaman dan cocok untuk digunakan makan bersama Keluarga. Warung Iwak ini berada di Jl. Monginsidi Sukorejo Kidul, Sukorejo, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur</p>
            <a class="btn btn-pesan" href="detail-pesan.html">Pesan</a>
        </div>
        <div class="col-4 d-flex flex-column justify-content-end align-items-center">
            <div class="image"></div>
        </div>
    </section>
    <section class="best-seller">
        <div class="row row1">
            <p class="title">Best Seller </p>
        </div>
        <div class="row row2 justify-content-center">
            <div class="col-3 content d-flex flex-column justify-content-center align-items-center">
                <div class="image" style="background-image: url('images/gurame.svg');"></div>
                <div class="best-seller-box">
                    <h2>Gurame</h2>
                    <p>Per paduan ikan yang fresh dan bumbu yang sedap lorem</p>
                    <div class="star">
                        <img src="images/Star 1.png" alt="">
                        <p style="margin-left: 5px;">4.5</p>
                    </div>
                </div>
            </div>
            <!-- Repeat other best-seller items here -->
        </div>
    </section>
    <section class="testi">
        <div class="row row1">
            <p class="title">Testimoni</p>
        </div>
        <!-- items 1 -->
        <div class="row row2 justify-content-center">
            <div class="col-3 content d-flex flex-column justify-content-center align-items-center">
                <div class="testi-box">
                    <img src="images/testiman-1.png" alt="">
                    <div class="testi-com row ">
                        <img src="images/star5.png" alt="">
                        <p>Rasanya enak, pelayanannya juga cepat</p>
                    </div>
                </div>
            </div>
            <!-- Repeat other testimonial items here -->
        </div>
    </section>

    <section class="gallery">
        <div class="row row1">
            <p class="title">Gallery</p>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/bt1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h5>SEJAK 1945</h5>
                        <p>Kami mempersembahkan hidangan istimewa yang dibuat dari bahan-bahan segar dan berkualitas tinggi</p>
                        <p><a href="#" class="btn btn-dark mt-3">Learn More</a></p>
                    </div>
                </div>
                <!-- Repeat other carousel items here -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <footer class="d-flex">
        <div class="instagram">
            <img src="images/ig-icons.png" alt="">
            <p>warungiwak.bjn</p>
        </div>
        <div class="telephone">
            <img src="images/fb-icons.png" alt="">
            <p>warungiwak</p>
        </div>
        <div class="instagram">
            <img src="images/wa-icons.png" alt="">
            <p>082256439241</p>
        </div>
    </footer>

    <!-- The Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Login</h2>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('loginPost') }}">
                    @csrf
                    <label for="login-username">Email:</label><br>
                    <input type="email" id="login-username" name="email"><br>
                    <label for="login-password">Password:</label><br>
                    <input type="password" id="login-password" name="password"><br><br>
                    <button type="submit" class="register">Login</button>
                </form>
                <a class="register-link" id="registerLinkFromLogin">Don't have an account? Register</a>
            </div>
            <div class="modal-footer">
                <button class="close">Close</button>
            </div>
        </div>
    </div>

    <!-- The Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Register</h2>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('regsiterPost') }}">
                    @csrf
                    <label for="register-username">Name:</label><br>
                    <input type="text" id="register-username" name="name"><br>
                    <label for="register-email">Email:</label><br>
                    <input type="email" id="register-email" name="email"><br>
                    <label for="register-password">Password:</label><br>
                    <input type="password" id="register-password" name="password"><br>
                    <label for="register-password-confirm">Confirm Password:</label><br>
                    <input type="password" id="register-password-confirm" name="password_confirmation"><br><br>
                    <button type="submit" class="register">Register</button>
                </form>
                <a class="login-link" id="loginLinkFromRegister">Already have an account? Login</a>
            </div>
            <div class="modal-footer">
                <button class="close">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginLink').addEventListener('click', function() {
            document.getElementById('loginModal').style.display = 'block';
        });



        document.getElementById('registerLinkFromLogin').addEventListener('click', function() {
            document.getElementById('loginModal').style.display = 'none';
            document.getElementById('registerModal').style.display = 'block';
        });

        document.getElementById('loginLinkFromRegister').addEventListener('click', function() {
            document.getElementById('registerModal').style.display = 'none';
            document.getElementById('loginModal').style.display = 'block';
        });

        document.querySelectorAll('.close').forEach(function(element) {
            element.addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    </script>
</body>
</html>
