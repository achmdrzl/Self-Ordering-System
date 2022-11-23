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
        // API Location
        $location = Location::get();

        // Order Review for Chef Roles
        $orders = Order::orderBy('id', 'DESC')->get();

        // Total Orders this Day
        $orderThisDay =
            Invoice::groupBy('order_date')
            ->selectRaw('*, count(total) as total')
            ->orderByRaw('order_date DESC')
            ->first();

        // Amount Income this Day
        $totalThisDay =
            Invoice::groupBy('order_date')
            ->selectRaw('*, sum(total) as total')
            ->orderByRaw('order_date DESC')
            ->first();

        // Total Income
        $grandTotal = Invoice::sum('total');

        // Total Table u have
        $table = Customer::count();

        // Total Table Where Condition is "Free"
        $free = Customer::where('status', 'Free')->get();
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

        return view('employee.dashboard', compact('location', 'orders', 'totalThisDay', 'grandTotal', 'table', 'tableFree', 'totalSales', 'month', 'reportChart', 'orderThisDay'));
    }

    public function show(Request $request, $id)
    {
        $orders = Order::with(['orderProduct.product'])->where('id', $id)->first();

        return view('employee.chef.show', compact('orders'));
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
        return redirect()->back();
    }
}
