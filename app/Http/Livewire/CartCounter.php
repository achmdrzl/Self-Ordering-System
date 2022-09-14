<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{

    protected $listeners = ['cartUpdated' => 'render'];

    public function render()
    {
        $cart_count = Cart::content()->count();
        // $subtotal = Cart::subtotal();

        return view('livewire.cart-counter', compact('cart_count'));
    }
}
