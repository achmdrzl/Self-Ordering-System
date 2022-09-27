<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $no_table = request()->session()->get('no_table');
        
        // $orders = Order::where('table_id', $no_table)->orWhere('status_order', 'Cooked')->orWhere('status_order', 'Waiting')->orWhere('status_order', 'On the Way')->get();
        
        $orders =
            Order::where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'Waiting');
            })->where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'Cooked');
            })->where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'On the Way');
            })->get();

        return view('frontend.order.orderSuccess', compact('orders'));
    }
}
