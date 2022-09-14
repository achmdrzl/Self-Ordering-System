<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartList extends Component
{

    public $rowId;

    public int $qty = 0;

    public function render()
    {

        $products = Cart::content();
        $imgs = [];
        foreach ($products as $cart) {
            $imgs = Product::find($cart->id)->get();
        }

        return view('livewire.cart-list', compact('products', 'imgs'));
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);

        $this->emit('cartUpdated');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);

        $this->emit('cartUpdated');
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);

        $this->emit('cartUpdated');

        return ([
            'message' => 'Table Deleted Successfully',
            'type' => 'danger'
        ]);

    }
}
