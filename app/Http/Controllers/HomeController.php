<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use PDO;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::with('category')->get(['id', 'name_product', 'price', 'slug']);
        // return view('frontend.homepage', compact('products'));

        return view('frontend.homepage');
    }

    public function getCategories()
    {
        // $products = Product::with('category')->get(['id', 'name_product', 'price', 'slug']);
        $category = Category::where('status', 'active')->get();
        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }

    public function welcomePage(Request $request, $no_table)
    {

        $request->session()->put('no_table', $no_table);

        $no_table = request()->session()->get('no_table');

        $table = Customer::where('no_table', $no_table)->first();

        if ($table) {
            if ($table->status === "Check-In") {
                return abort(403, 'Unauthorized action.');
            }
            return redirect()->route('homepage');
        } else {
            return abort(404, 'Not Found');
        }
    }

    public function checkTable(Request $request)
    {
        $result = 0;
        if($request->data){

        }
    }
}
