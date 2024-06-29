<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Create Product') }}
                        <a href="{{ route('index_product') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                    <div class="card-body">
                        <form action="{{route('store_product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" placeholder="Masukkan Nama" class=" form-control"
                                        id="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi : </label>
                                <div class="col-sm-10">
                                    <input type="text" name="deskripsi" placeholder="Masukkan deskripsi"
                                        class=" form-control" id="deskripsi">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga" class="col-sm-2 col-form-label">Harga : </label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga" placeholder="Masukkan harga" class=" form-control"
                                        id="harga">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="stok" class="col-sm-2 col-form-label">Stok : </label>
                                <div class="col-sm-10">
                                    <input type="number" name="stok" placeholder="Masukkan stok" class=" form-control"
                                        id="stok">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="stok" class="col-sm-2 col-form-label">Gambar : </label>
                                <div class="col-sm-10">
                                    <input type="file" placeholder="Upload Gambar Produk" class=" form-control"
                                        name="gambar"><br>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection


</body>

</html>