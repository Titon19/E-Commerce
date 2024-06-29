<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Product</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex justify-content-between">{{ __('Products') }}
                        <div class="menu-product-cart d-flex justify-content-end gap-2">


                            @if (Auth::check() && Auth::user()->is_admin)
                                <a href="{{ route('create_product') }}" class="btn btn-success">Buat Product</a>

                            @elseif(Auth::check() && !Auth::user()->is_admin)
                                <a href="{{ route('show_cart') }}" class="btn btn-warning">Carts</a>
                            @endif


                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center gap-3">
                        @foreach ($products as $product)
                            <div class="card" style="width: 11rem;">
                                <img src="{{ url('storage/' . $product->gambar) }}" alt="gProduct" class="card-img-top">
                                <div class="card-body d-grid align-content-between">
                                    <h5 class="card-title">
                                        <p>{{ $product->nama }}</p>
                                    </h5>
                                    <div class="d-grid row-gap-2">
                                        <form action="{{ route('show_product', $product) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Show Detail</button>
                                        </form>
                                        <form id="delete_form_{{ $product->id }}"
                                            action="{{ route('delete_product', $product->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            @if (Auth::check() && Auth::user()->is_admin)
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $product->id }}, event)">Delete
                                                    Product</button>
                                            @endif

                                        </form>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script>
        function confirmDelete(productId, event) {
            if (confirm("Apakah anda yakin ingin menghapus product ini?")) {
                // Jika OK, submit form delete
                document.getElementById('delete_form_' + productId).submit();
            } else {
                // Jika Cancel, batalkan tindakan
                event.preventDefault();
            }
        }
    </script>

</body>

</html>