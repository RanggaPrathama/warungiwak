<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text:wght@100..900&display=swap"
        rel="stylesheet">
        <style>

        </style>
</head>

<body class="detail">
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
    <section class="container-detail">
        <div class="container" style="max-width:900px;border-radius:30px; background-color: rgb(194, 194, 194)">
            <div class="row justify-content-center align-items-center">
                @foreach ($carts as $cart )
                <div class="col-lg-8 d-flex my-4" data-idproduct="{{$cart->id_product}}" data-quantity="{{$cart->quantity}}" data-hargaproduct="{{$cart->harga_product}}" style="background-color:rgb(235, 235, 235); border-radius:30px">
                    <img class="img-fluid" src="{{asset('product/'.$cart->gambar_product)}}" alt="">
                    <div class="flex-column px-4 py-4">
                    <h2 class="title">{{$cart->nama_product}}</h2>
                    <p class="price">Rp. {{$cart->harga_product}}</p>
                    <input type="number" value="{{$cart->quantity}}" min="1" class="form-control quantity" >
                </div>
                </div>
                @endforeach

                <form id="formPembayaran" method="POST" action="{{route('pemesanan.store')}}">
                    @csrf
                <div class="col-lg-12 d-flex justify-content-end py-3">
                    <h2 class="px-3">Total :</h2>
                    <h3 class="subtotalDisplay">Rp.100.000</h3>
                    <input type="hidden" name="totalHarga" class="totalHarga">
                </div>
                <div class="col-lg-12 d-flex justify-content-end py-4">
                <h3 class="px-3">Payment : </h3>
                  <select style="max-width: 250px" name="id_payment" class="form-control id_payment" id="">
                    @foreach ($payments as $payment )
                    <option value="{{$payment->id_payment}}">{{$payment->nama_bank}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        <button class="lanjut buttonPembayaran" >PESAN</button>
    </div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
  </script>
  <script src="cart.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    $(document).ready(function(){
    let data = [];
    $('[data-idproduct]').each(function(){
        data.push({
            'id_product' : $(this).data('idproduct'),
            'quantity' : $(this).data('quantity'),
            'harga_product' : $(this).data('hargaproduct')
        })


        let updateSubtotal = function() {
                let subtotal = 0;
                data.forEach(item => {
                    subtotal += item.quantity * item.harga_product;
                });

               $('.totalHarga').val(subtotal)
               let total = $('.totalHarga').val()
                console.log(total);
                $('.subtotalDisplay').text(subtotal.toLocaleString(
                    'id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }
                ));
            };

            updateSubtotal();

            $('.quantity').on('input', function() {
                let id = $(this).data('id');
                let newQuantity = parseInt($(this).val());
                let index = data.findIndex(item => item.idDetail_cookies === id);
                if (index !== -1) {
                    data[index].quantity = newQuantity;
                    updateSubtotal();
                    console.log(data)

                }
                console.log(data);
            });

            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.buttonPembayaran', function(e) {
        e.preventDefault();

        let form = $('#formPembayaran');
        let totalHarga = $('.totalHarga').val();
        let idPayment = $('.id_payment').val();
        console.log(idPayment);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: {
                dataCart: JSON.stringify(data),
                totalHarga: totalHarga,
                id_payment : idPayment
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Data Tersimpan!",
                        text: "Silahkan Klik Melanjutkan Pemesanan!",
                        icon: "success"
                    }).then(function(){
                        window.location.href = '/katalog';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message || 'Something went wrong!',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });



    })
});
  </script>
</body>

</html>
