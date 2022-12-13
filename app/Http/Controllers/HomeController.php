<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use PDO;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $menu_categories = Category::where('status', 'active')->get();
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
        // Get Data Meja
        $request->session()->put('no_table', $no_table);

        $no_table = request()->session()->get('no_table');

        // Find Data Meja
        $table = Customer::where('no_table', $no_table)->first();

        // Check Waktu
        date_default_timezone_set('Asia/Jakarta');
        $cek_waktu = date("H");

        // Validasi Data Meja
        if ($table) {
            // dd($cek_waktu);
            // Validasi Waktu
            if ($cek_waktu >= 10 && $cek_waktu >= 24 ) {
                
                return view('frontend.errorTime');

            } else {
                if ($table->status === "Check-In" || $table->status === 'Unactive') {
                    return view('frontend.error403');
                }
                return redirect()->route('homepage');
            }

        } else {
            return view('frontend.error404');
        }
    }
}
