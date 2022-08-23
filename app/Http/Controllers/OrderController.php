<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function process()
    {
        return view('frontend.order.checkout');
    }

    public function finished(){

        return view('frontend.order.orderSuccess');
    }
}
