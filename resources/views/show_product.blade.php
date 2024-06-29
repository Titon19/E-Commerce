<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product | {{ $product->nama }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Product Detail') }}
                        <a href="{{ route('index_product') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                    <div class="p-2 m-3 product-details">
                        <div class="product-image">
                            <img src="{{ url('storage/' . $product->gambar) }}" alt="gProduct" class="card-img-top">
                        </div>
                        <div class="d-block">
                            <div class="card-body">
                                <h5 class="card-title"> {{ $product->nama }}</h5>
                                <table>
                                    <tr>
                                        <td style="width: 100px">
                                            <h5 class="card-text">Harga</h5>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <h5 class="card-text">Rp. {{ $product->harga }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px">
                                            <p class="card-text">Deskripsi</p>
                                        </td>
                                        <td>:</td>
                                        <td style="width: 100px">
                                            <p class="card-text">{{ $product->deskripsi }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px">
                                            <p class="card-text">Stok</p>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <p class="card-text">{{ $product->stok }}</p>
                                        </td>
                                    </tr>
                                </table>


                                <div class="aksi">
                                    <form action="{{ route('edit_product', $product) }}" method="get">
                                        @csrf
                                        @if (Auth::user()->is_admin)
                                            <button type="submit" class="btn btn-primary mb-2">Edit Product</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('add_to_cart', $product) }}" method="post" class="d-flex">
                                        @csrf
                                        @if (!Auth::user()->is_admin)
                                            <div class="input-group mb-3">
                                                <input type="number" name="jumlah" class="form-control"
                                                    placeholder="Masukkan Jumlah" aria-label="Masukkan Jumlah" value="1"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-outline-success" type="submit" id="button-addon2">Add
                                                    To Cart</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection


</body>

</html>