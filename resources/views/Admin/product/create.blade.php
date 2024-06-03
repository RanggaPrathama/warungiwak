
@extends('layout.layoutAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Data Product</h1>

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </nav>
      <!-- /resources/views/post/create.blade.php -->


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Create Post Form -->
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Create Product</h5>
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                  <div class="col-lg-6">

                      <label for="">Nama product</label>
                      <input type="text" name="nama_product" class="form-control  @error('nama_product')
                      is-invalid
                      @enderror" >
                      @error('nama_product')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror
                      <br>

                      <label for="">Kategori product</label>
                        <select class="form-control" name="id_kategori" id="">
                            <option value="" selected> Silahkan memilih kategori </option>
                            @foreach ( $kategoris as $kategori )
                            <option value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                      @error('nama_product')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror

                      <br>

                      <label for="">Stok product</label>
                      <input type="number" name="stok" min="1" class="form-control @error('stok')
                          is-invalid
                      @enderror" >
                      @error('stok')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror
                      <br>
                      <label for="">Harga product</label>
                      <input type="number" name="harga_product" class="form-control @error('harga_product')
                        is-invalid
                      @enderror" >
                      @error('harga_product')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror
                      <br>
                      <label for="">Gambar product</label>
                      <input type="file" name="gambar_product" class="form-control @error('gambar_product')
                        is-invalid
                      @enderror">
                      @error('gambar_product')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror

                  </div>
                  <div class="text-end py-4" >
                    <button type="submit" class="btn btn-primary"> Create Data</button>
                 </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>

  </main><!-- End #main -->
@endsection


