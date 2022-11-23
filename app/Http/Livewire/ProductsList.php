<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsList extends Component
{

    public $rowId;
    public int $qty = 0;

    protected $listeners = ['productUpdated' => 'render'];

    public function render()
    {
        $products = Product::all();
        return view('livewire.products-list', compact('products'));
    }

    public function increaseQuantity($rowId)
    {
        $product = Product::find($rowId);
        $qty = $product->stock + 1;
        $product->update([
            'stock' => $qty
        ]);

        $this->dispatchBrowserEvent('productUpdated');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Product::find($rowId);
        $qty = $product->stock - 1;
        $product->update([
            'stock' => $qty
        ]);

        $this->dispatchBrowserEvent('productUpdated');
    }


}
