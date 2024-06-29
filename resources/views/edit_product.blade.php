<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | {{ $product->nama }}</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">{{ __('Edit Product') }}
                        <a href="{{ route('show_product', $product) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                    <div class="card-body">
                        <form action="{{ route('update_product', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" value="{{ $product->nama }}" class=" form-control"
                                        id="nama">
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi : </label>
                                <div class="col-sm-10">
                                    <input type="text" name="deskripsi" value="{{ $product->deskripsi }}"
                                        class=" form-control" id="deskripsi">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga" class="col-sm-2 col-form-label">Harga : Rp.</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga" value="{{ $product->harga }}"
                                        class=" form-control" id="harga">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="gambar" class="col-sm-2 col-form-label">Gambar : </label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar" class="form-control" id="gambar"
                                        onchange="updateFileName()">
                                    <small id="file-name">{{ $product->gambar }}</small>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Stok : </label>
                                <div class="col-sm-10">
                                    <input type="number" name="stok" value="{{ $product->stok }}" class=" form-control"
                                        id="deskripsi">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Edit Product</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection
    <script>
        function updateFileName() {
            var fileInput = document.getElementById('gambar');
            var fileNameDisplay = document.getElementById('file-name');
            var fileName = fileInput.value.split('\\').pop();
            fileNameDisplay.textContent = fileName;
        }
    </script>
</body>

</html>