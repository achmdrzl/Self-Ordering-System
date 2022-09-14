<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $slug;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function render($slug)
    {
        // Get Products
        $products = Product::with('category');
        if (!is_null($slug)) {
            $category = Category::whereSlug($slug)->first();
            if (is_null($category->category_id)) {
                $categoriesId = Category::whereNameCategory($category->id)->pluck('id')->toArray();
                $categoriesId[] = $category->id;

                $products = Product::whereHas('category', function ($query) use ($categoriesId) {
                    $query->whereIn('id', $categoriesId);
                });
            } else {
                $products = Product::whereHas('category', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                });
            }
        }

        $product = $products;
        // dd($product);

        return view('livewire.product-list', [
            'products' => $this->search === null ? $product->paginate(5) : $product->where('name_product', 'like', '%' . $this->search . '%')->paginate(5),
        ]);
    }
}
