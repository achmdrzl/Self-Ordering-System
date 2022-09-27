<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartList extends Component
{

    public $rowId, $delete_id;

    public int $qty = 0;

    protected $listeners = [
        'deleteConfirmed' => 'deleteConfirm'
    ];

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
        $this->delete_id = $rowId;
        $this->dispatchBrowserEvent('show-delete-confirm');

    }

    public function deleteConfirm()
    {
        Cart::remove($this->delete_id);

        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('tableDeleted');
    }
}
