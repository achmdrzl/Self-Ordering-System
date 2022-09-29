<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('invoice')->latest()->get();
        return view('employee.manager.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orders, $id)
    {
        $orders = Order::with(['orderProduct.product'])->where('id', $id)->first();
        // Payment Detail
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Sum Total if repeat order has found
        $data = Order::where('table_id', $orders->table_id)->get();
        $cek = $data->whereNotIn('status_order', 'Finished')->sum('total');

        if ($orders->invoice->status == 'Settlement' || $orders->invoice->status == 'settlement') {
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => intval(500000),
                ),
                'customer_details' => array(
                    'first_name' => "Example",
                    'last_name' => '',
                    'email' => 'ogani@gmail.com',
                    'phone' => '08123456678',
                ),
            );
        } else {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $orders->orderCode,
                    // 'order_id' => rand(),
                    'gross_amount' => intval($cek),
                ),
                'customer_details' => array(
                    'first_name' => "Table " . $orders->table_id,
                    'last_name' => '',
                    'email' => 'ogani@gmail.com',
                    'phone' => '08123456678',
                ),
            );
        }

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('employee.manager.order.show', compact('orders', 'snapToken'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        $orderProduct = OrderProduct::where('order_id', $order->id)->delete();

        return redirect()->route('orders.index')->with([
            'message' => 'Order Deleted Successfully',
            'type' => 'danger'
        ]);
    }

    public function printPDF($id)
    {
        $orders = Order::with(['orderProduct.product', 'invoice'])->where('id', $id)->first();

        $customPaper = array(0, 0, 720, 1440);
        $pdf = FacadePdf::loadView('employee.cashier.bill.printPDF', compact('orders'))->setPaper($customPaper, 'portrait');

        return $pdf->download('INVOICE #' . strtoupper($orders->orderCode) . '.pdf');
    }
}
