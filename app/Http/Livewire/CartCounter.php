<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{

    protected $listeners = ['cartUpdated' => 'render'];

    public function render()
    {
        $cart_count = Cart::content()->count();

        // get no table & status order in order to count it.
        $table =
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
            })->count();

        return view('livewire.cart-counter', compact('cart_count', 'table'));
    }
}
