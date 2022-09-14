<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product){
        
        $related_product = Product::whereHas('category', function($query) use ($product){
            $query->whereId($product->category_id);
        })
        ->where('id', '<>', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get(['id', 'name_product', 'slug', 'price']);

        return view('frontend.product.show', compact('product', 'related_product'));
    }
}
