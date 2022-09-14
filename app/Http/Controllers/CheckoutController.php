<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::content();
        return view('frontend.order.checkout', compact('carts'));
    }

    public function show()
    {
        return view('frontend.order.orderSuccess');
    }
}
