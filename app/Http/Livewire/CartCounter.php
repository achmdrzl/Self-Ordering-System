<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{

    protected $listeners = ['cartUpdated' => 'render'];

    public function render()
    {
        $cart_count = Cart::content()->count();
        $no_table = request()->session()->get('no_table');

        // get no table & status order in order to count it.
        $table =
            Order::where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'Waiting');
            })->where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'Cooked');
            })->where(function ($query) {
                $no_table = request()->session()->get('no_table');
                $query->where('table_id', $no_table)->orWhere('status_order', 'On the Way');
            })->count();
        

        return view('livewire.cart-counter', compact('cart_count', 'table'));
    }
}
