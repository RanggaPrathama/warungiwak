
@extends('layout.layoutAdmin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Data Product</h1>

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </nav>
      <!-- /resources/views/post/Update.blade.php -->


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

<!-- Update Post Form -->
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update Product</h5>
                    <form action="{{ route('product.update',$products->id_product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                  <div class="col-lg-6">

                      <label for="">Nama product</label>
                      <input type="text" value="{{old('nama_product', $products->nama_product)}}" name="nama_product" class="form-control  @error('nama_product')
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
                          @foreach ( $kategoris as $kategori )
                          <option {{$products->id_kategori == $kategori->id_kategori ? 'selected' : ''}} value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}</option>
                          @endforeach
                      </select>
                    @error('nama_product')
                      <div class="alert alert-danger">
                          {{$message}}
                      </div>
                    @enderror

                    <br>

                      <label for="">Stok product</label>
                      <input type="number" value="{{old('stok',$products->stok)}}" name="stok" min="1" class="form-control @error('stok')
                          is-invalid
                      @enderror" >
                      @error('stok')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                      @enderror
                      <br>
                      <label for="">Harga product</label>
                      <input type="number" value="{{old('harga_product',$products->harga_product)}}" name="harga_product" class="form-control @error('harga_product')
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
                    <button type="submit" class="btn btn-primary"> Update Data</button>
                 </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>

  </main><!-- End #main -->
@endsection


