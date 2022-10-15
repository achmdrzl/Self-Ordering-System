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
        $menu_categories = Category::all();
        return view('frontend.homepage', compact('menu_categories'));
    }

    public function getCategories()
    {
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
                return view('frontend.error403');
            }
            return redirect()->route('homepage');
        } else {
            return view('frontend.error404');
        }
    }
}
