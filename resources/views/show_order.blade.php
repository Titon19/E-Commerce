<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail | {{ $order->user->name }}</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Order Detail') }}
                        <a href="{{ route('index_order') }}" class="btn btn-secondary">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Order ID : {{ $order->id }}</h5>
                                <p>Nama : {{ $order->user->name }}</p>

                                <h5>Transaksi : </h5>
                                @php
                                    $total_harga = 0;
                                @endphp
                                @foreach ($order->transactions as $transaction)
                                                                <p>Product : {{ $transaction->product->nama }} <br>
                                                                    Jumlah : {{ $transaction->jumlah }}
                                                                </p>
                                                                @php
                                                                    $total_harga += $transaction->product->harga * $transaction->jumlah;
                                                                @endphp
                                @endforeach
                                <h5>Total : Rp. {{ $total_harga }}</h5>
                                @if ($order->is_paid == false && $order->bukti_bayar == null)
                                    <form action="{{route('bukti_bayar_order', $order)}}" method="post"
                                        enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <label for="bukti_bayar">
                                            <h5>Bukti Pembayaran : </h5>
                                        </label><br>
                                        <input type="file" id="bukti_bayar" name="bukti_bayar" class="form-control"><br>
                                        <button type="submit" class="btn btn-success">Kirim</button>
                                    </form>
                                @else
                                    <h5>Bukti Pembayaran : </h5>
                                    <img src="{{ url('storage/' . $order->bukti_bayar) }}" alt="gBuktiBayar" height="100px">
                                @endif
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