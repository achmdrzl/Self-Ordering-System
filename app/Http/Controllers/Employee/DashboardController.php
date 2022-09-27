<?php

namespace App\Http\Controllers\Employee;

use App\Charts\ReportChart;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:manager'])->only('cek');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $locationData = Location::get('https://' . $request->ip()); // https or http according to your necessary.
        // return view('welcome', compact('locationData'));

        // API Location
        $location = Location::get();

        // Order Review for Chef Roles
        $orders = Order::all();

        // Total Orders this Day
        $orderThisDay =
            Invoice::groupBy('order_date')
            ->selectRaw('*, count(total) as total')
            ->orderByRaw('order_date ASC')
            ->first();

        // Amount Income this Day
        $totalThisDay =
            Invoice::groupBy('order_date')
            ->selectRaw('*, sum(total) as total')
            ->orderByRaw('order_date ASC')
            ->first();
        // dd($totalThisDay);
        // Total Income
        $grandTotal = Invoice::sum('total');

        // Total Table u have
        $table = Customer::count();

        // Total Table Where Condition is "Free"
        $free = Customer::where('status', 'Check-In')->get();
        $tableFree = $free->count();

        // Grafik Sales
        $totalSales =
            Invoice::groupBy(DB::raw("Month(order_date)"))
            ->selectRaw('*, sum(total) as total')
            ->pluck('total')->toArray();

        $month =
            Invoice::groupBy(DB::raw("Month(order_date)"))
            ->selectRaw('MONTHNAME(order_date) as month')
            ->pluck('month')->toArray();

        $reportChart = new ReportChart;
        $reportChart->labels($month);
        $reportChart->dataset('Total Income per Month', 'line', $totalSales)->backgroundColor('#5f52b6')->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        // $test = User::create([
        //     'email' => 'abc@gmail.com',
        //     'name' => 'abc',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        // $test->assignRole('chef');

        return view('employee.dashboard', compact('location', 'orders', 'totalThisDay', 'grandTotal', 'table', 'tableFree', 'totalSales', 'month', 'reportChart', 'orderThisDay'));
    }

    public function show(Request $request, $id)
    {
        $orders = Order::with(['orderProduct.product'])->where('id', $id)->first();
        $pro = OrderProduct::with('product')->where('order_id', $orders->id)->get();
        // $orderProduct = OrderProduct::where('order_id', $orders->id)->get();
        // foreach($orders as $order){
        //     // $item = OrderProduct::with(['products'])->where('id', $order->id)->first();
        // }
        // $orderProducts = OrderProduct::with(['products', 'order'])->where('order_id', $id)->get();
        // $orderProducts = OrderProduct::with(['products', 'order'])->where('order_id', $id)->get();
        // $item = Order::where('id', $id)->get();

        // foreach ($orders as $row) {
        //     $orderProducts = OrderProduct::where('order_id', $row->id)->get();
        // }

        // foreach ($orders as $item) {
        //     $product = OrderProduct::where('order_id', $item->id)->get();
        //     foreach ($product as $data) {
        //         // dd($data->product_id);
        //         foreach ($data->product_id as $x) {
        //             $detail = Product::where('id', $x)->get();
        //         }
        //     }
        // }
        // dd($product);

        // foreach ($orders->orderProduct as $item) {
        //     $data = DB::table('products')
        //         ->select('*')
        //         ->where('id', $item->product_id)
        //         ->get();
        //     // dd($data);
        // }

        return view('employee.chef.show', compact('orders', 'pro'));
    }

    public function update_status(Request $request, $id)
    {
        $orders = Order::where('id', $id)->get();
        foreach ($orders as $order) {
            if ($order->status_order === 'Cooked') {
                $order->update([
                    'status_order' => 'On the Way'
                ]);
            } elseif ($order->status_order === 'Waiting') {
                $order->update([
                    'status_order' => 'Cooked'
                ]);
            }
        }

        return redirect()->route('dashboard');
    }
}
