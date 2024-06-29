<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();


        if ($carts == null) {
            return view('show_order', compact('order'));
        }


        $order = Order::create(
            [
                'user_id' => $user_id
            ]
        );

        foreach ($carts as $cart) {

            $product = Product::find($cart->product_id);

            $product->update(
                [
                    'stok' => $product->stok - $cart->jumlah
                ]
            );
            Transaction::create(
                [
                    'jumlah' => $cart->jumlah,
                    'product_id' => $cart->product_id,
                    'order_id' => $order->id
                ]
            );

            $cart->delete();
        }
        return Redirect::route('show_order', compact('order'));
    }

    public function index_order()
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if (Auth::user()->is_admin) {
            $orders = Order::all();//tampilkan semua order jika yang sedang login adalah admin
        } else {
            $orders = Order::where('user_id', $user->id)->get();//tampilkan semua order berdasarkan user id yang sedang login
        }
        return view('index_order', compact('orders'));
    }

    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if ($is_admin || $order->user_id == $user->id) {//user id di order sama atau tidak dengan user id di login
            return view('show_order', compact('order'));//jika sama maka akan ditampilkan semua data order sesuai user id di tabel order dan tabel user
        }

        return Redirect::route('index_order');//Jika tidak sama maka akan di redirect ke index_order

    }

    public function bukti_bayar_order(Order $order, Request $request)
    {
        $request->validate(
            [
                'bukti_bayar' => 'required'
            ]
        );


        $file = $request->file('bukti_bayar');
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));


        $order->update(
            [
                'bukti_bayar' => $path
            ]
        );

        return Redirect::route('show_order', $order);
    }


    public function konfirmasi_bayar(Order $order)
    {
        $order->update(
            [
                'is_paid' => true
            ]
        );
        return Redirect::back();
    }


}
