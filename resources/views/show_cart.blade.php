<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carts</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Carts') }}
                        <a href="{{ route('index_product') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                    @php
                     $total_harga = 0;
                    @endphp
                    <div class="card-body d-flex gap-2 justify-content-center pb-0">
                        @foreach ($carts as $cart)
                            <div class="card p-2">
                                <div class="gambar d-flex justify-content-center">
                                <img class="rounded-4" src="{{ url('storage/' . $cart->product->gambar) }}" alt="gProduct" width="200px">
                                </div> 
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cart->product->nama }}</h5>
                                    <form action="{{ route('update_cart', $cart) }}" method="post">
                                        @method('patch')
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="number" name="jumlah" class="form-control"
                                                placeholder="Masukkan Jumlah"aria-label="Masukkan Jumlah" value="{{ $cart->jumlah }}"
                                                aria-describedby="button-addon2">
                                            <button type="submit" class="btn btn-outline-success" id="button-addon2">Update
                                                Jumlah</button>
                                        </div>
                                    </form>
                                    <form id="delete_form_{{ $cart->id }}" action="{{ route('delete_cart', $cart->id) }}"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cart->id }}, event)">Delete
                                            Item</button>
                                    </form>
                                </div>
                            </div>
                            @php
                                $total_harga += $cart->product->harga * $cart->jumlah;
                            @endphp
                        @endforeach
                       
                    </div>
                    <div class="card-body d-flex justify-content-between">
                    <p>Total : Rp. {{ $total_harga }}</p>
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            @if (empty($cart))
                            <button disabled type="submit" class="btn btn-warning">Checkout</button>
                            @else
                            <button type="submit" class="btn btn-warning">Checkout</button>
                            @endif
                        </form>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script>
        function confirmDelete(cartId, event) {
            if (confirm("Apakah anda yakin ingin menghapus cart ini?")) {
                // Jika OK, submit form delete
                document.getElementById('delete_form_' + cartId).submit();
            } else {
                // Jika Cancel, batalkan tindakan
                event.preventDefault();
            }
        }
    </script>
</body>

</html>