<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
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
        // $no_table = request()->session()->get('no_table');

        // $customer = Customer::where('no_table', $no_table)->first();

        $orders =
            Order::where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $customer = Customer::where('no_table', $no_table)->first();
                $query->where('table_id', $customer->id)->where('status_order', 'Waiting');
            })->orWhere(function ($query) {
                $no_table = request()->session()->get('no_table');
                $customer = Customer::where('no_table', $no_table)->first();
                $query->where('table_id', $customer->id)->where('status_order', 'Cooked');
            })->orWhere(function ($query) {
                $no_table = request()->session()->get('no_table');
                $customer = Customer::where('no_table', $no_table)->first();
                $query->where('table_id', $customer->id)->where('status_order', 'On the Way');
            })->get();

        return view('frontend.order.orderSuccess', compact('orders'));
    }
}
