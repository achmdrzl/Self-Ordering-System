<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductAddToCart extends Component
{
    public function render(Product $product)
    {
        $related_product = Product::whereHas('category', function ($query) use ($product) {
            $query->whereId($product->category_id);
        })
            ->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'name_product', 'slug', 'price']);

        return view('livewire.product-add-to-cart', compact('product', 'related_product'));
    }
}
