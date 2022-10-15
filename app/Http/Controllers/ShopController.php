<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index(Request $request, $slug = null)
    {
        // Sorting Products
        $sorting = $request->sortingBy;
        switch($sorting){
            case 'low-high':
                $sortField = 'price';
                $sortBy = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortBy = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortBy = 'asc';
            break;
        }

        // Get Products
        $products = Product::with('category');
        if(!is_null($slug)){
            $category = Category::whereSlug($slug)->first();
            if(is_null($category->category_id)){
                $categoriesId = Category::whereNameCategory($category->id)->pluck('id')->toArray();
                $categoriesId[] = $category->id;

                $products = Product::whereHas('category', function($query) use ($categoriesId){
                    $query->whereIn('id', $categoriesId);
                });
            }else{
                $products = Product::whereHas('category', function($query) use ($slug){
                    $query->where('slug', $slug);
                });
            }
        }

        $products = $products->where('status', 'active')->orderBy($sortField, $sortBy)->paginate(5);

        return view('frontend.shop.index', compact('products', 'sorting'));

    }

    // React Function
    public function getProducts(Request $request, $slug = null){

        $slug = $request->slug;
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

        $products = $products->paginate(5);

        return response()->json([
            'status' => 200, 
            'products' => $products
        ]);
    }

    public function sortingItems(Request $request){

        // Sorting Products
        $sorting = $request->sortingBy;
        switch ($sorting) {
            case 'low-high':
                $sortField = 'price';
                $sortBy = 'asc';
                break;
            case 'high-low':
                $sortField = 'price';
                $sortBy = 'desc';
                break;
            default:
                $sortField = 'id';
                $sortBy = 'asc';
                break;
        }

        $sorting = $sorting->orderBy($sortField, $sortBy)->paginate(5);

        return response()->json([
            'status' => 200,
            'sorting' => $sorting
        ]);

    }
}
