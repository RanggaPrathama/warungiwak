<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text:wght@100..900&display=swap"
        rel="stylesheet">
</head>

<body class="ourmenu">
    <nav class="navbar">
        <div class="navbar-left">
            <img class="image" src="images/iwakcok.svg" alt="">
            <p style="font-family: Big Shoulders Text; color:#fff; font-size: 40px; margin: 0; font-weight: 600;">WARUNG IWAK</p>
        </div>
        <div class="navbar-right">
            <a class="link" href="{{route('homeUser')}}">Home</a>
            <a class="link" href="{{route('katalog')}}">Menu</a>
            <a class="link" href="{{route('cart.index',auth()->user()->id_user)}}">Pesan</a>
            <a class="link" href=" {{ route('logout') }}"  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" >Logout</a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <section class="container-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row row1">
            <p class="title">Our Menu</p>
        </div>
        <div class="col-lg-12 m-auto">
            <div class="row row2 text-center">
                @foreach ($kategoris as $kategori)
                    <a href="javascript:void(0);" class="col-3 category" data-idkategori="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                @endforeach
            </div>
        </div>
        <div class="row box-content">
            <!-- Dynamic menu items will be loaded here -->
        </div>
    </section>

    <div class="d-flex justify-content-center">
        <a style="text-decoration: none;" href="{{route('cart.index',auth()->user()->id_user)}}" class="quantity">Checkout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.category').click(function () {
                var idkategori = $(this).data('idkategori');
                $.ajax({
                    url: '{{ route('getProduct') }}',
                    type: 'GET',
                    data: { idkategori: idkategori },
                    success: function (response) {
                        $('.box-content').empty();

                        response.products.forEach(function (product) {
                            var menuItem = `
                                <div class="menu-item">
                                    <div class="image-circle" style="background-image: url('{{ asset('product/') }}/${product.gambar_product}');"></div>
                                    <div class="desk">
                                        <p class="title">${product.nama_product}</p>
                                        <div class="order">
                                            <p class="price">Rp. ${product.harga_product}</p>
                                            <button type="button" class="btn btn-outline-dark add-to-cart" data-idproduct="${product.id_product}">+</button>
                                        </div>
                                    </div>
                                </div>`;
                            $('.box-content').append(menuItem);
                        });

                        $('.add-to-cart').click(function () {
                            var idProduct = $(this).data('idproduct');
                            addToCart(idProduct);
                        });
                    },
                    error: function (error) {
                        console.log('Error fetching products:', error);
                    }
                });
            });

            function addToCart(idProduct) {
                $.ajax({
                    url: '{{ route('cart.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_product: idProduct,
                        quantity: 1
                    },
                    success: function (response) {
                        alert('Product added to cart successfully!');
                    },
                    error: function (error) {
                        console.log('Error adding to cart:', error);
                    }
                });
            }
        });
    </script>
</body>

</html>
