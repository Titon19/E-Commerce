<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Order</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex justify-content-between">{{ __('Orders') }}
                        <a href="{{ route('index_product') }}" class="btn btn-secondary">Kembali</a>
                    </div>

                    <div class="card-body d-grid row-gap-2">
                        @foreach ($orders as $order)
                            <div class="card">
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td style="width: 150px">
                                                <h5 class="card-title"><strong>Order ID</strong></h5>
                                            </td>
                                            <td>
                                                <p>:</p>
                                            </td>
                                            <td>
                                                <h5 class="card-title">{{ $order->id }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px">
                                                <p><strong>Nama</strong></p>
                                            </td>
                                            <td>
                                                <p>:</p>
                                            </td>
                                            <td>
                                                <p>{{ $order->user->name }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px">
                                                <p><strong>Dibuat pada</strong></p>
                                            </td>
                                            <td>
                                                <p>:</p>
                                            </td>
                                            <td>
                                                <p>{{ $order->created_at }}</p>
                                            </td>
                                        </tr>
                                        @if ($order->is_paid == true)
                                            <tr>
                                                <td style="width: 150px">
                                                    <p><strong>Status</strong></p>
                                                </td>
                                                <td>
                                                    <p>:</p>
                                                </td>
                                                <td>
                                                    <p>Paid</p>
                                                </td>
                                            </tr>
                                            @if ($order->is_paid == true)
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-warning"
                                                            href="{{ url('storage/' . $order->bukti_bayar) }}" target="_blank">Show
                                                            Bukti Bayar</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td>
                                                    <p><strong style="width: 100px">Status</strong></p>
                                                </td>
                                                <td>
                                                    <p>:</p>
                                                </td>
                                                <td>
                                                    <p>Unpaid</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>

                                    <div class="aksi d-grid row-gap-2 pt-2">
                                        <form action="{{ route('konfirmasi_bayar', $order) }}" method="post">
                                            @csrf
                                            @if (Auth::user()->is_admin)
                                                @if ($order->is_paid == true && $order->bukti_bayar != null)
                                                    <button disabled type="submit" class="btn btn-success">Konfirmasi
                                                        Pembayaran</button>
                                                @elseif($order->is_paid == false && $order->bukti_bayar == null)
                                                    <button disabled type="submit" class="btn btn-success">Konfirmasi
                                                        Pembayaran</button>
                                                @elseif($order->is_paid == false && $order->bukti_bayar != null)
                                                    <button type="submit" class="btn btn-success">Konfirmasi
                                                        Pembayaran</button>
                                                @endif()
                                            @endif

                                        </form>
                                        <form action="{{ route('show_order', $order) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Show Detail Order</button>
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



</body>

</html>