<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart(Product $product, Request $request)
    {

        $user_id = Auth::id();
        $product_id = $product->id;

        $existing_cart = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing_cart == null) {
            $request->validate(
                [
                    'jumlah' => 'required|gte:1|lte:' . $product->stok
                ]
            );

            Cart::create(
                [
                    'jumlah' => $request->jumlah,
                    'user_id' => $user_id,
                    'product_id' => $product_id
                ]
            );
        } else {
            $request->validate(
                [
                    'jumlah' => 'required|gte:1|lte:' . ($product->stok - $existing_cart->jumlah)
                ]
            );

            $existing_cart->update(
                [
                    'jumlah' => $existing_cart->jumlah + $request->jumlah
                ],
            );
        }

        return Redirect::route('show_cart');
    }

    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        if (!Auth::user()->is_admin) {
            return view('show_cart', compact('carts'));
        } else {
            return Redirect::route('index_product');
        }
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate(
            [
                'jumlah' => 'required|gte:1|lte:' . $cart->product->stok
            ]
        );

        $cart->update(
            [
                'jumlah' => $request->jumlah
            ]
        );

        return Redirect::route('show_cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::route('show_cart', compact('cart'));
    }

}
