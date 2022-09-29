<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cashlessPay(Request $request, $id)
    {
        // return $request;
        $data = json_decode($request->get('result'));
        $invoice = Invoice::where('id', $id)->first();

        $invoice->update([
            'status' => $data->transaction_status,
        ]);

        $orders = Order::where(
            'id',
            $id
        )->get();
        
        foreach ($orders as $order) {

            Customer::where('id', $order->table_id)->update([
                'status' => 'Free'
            ]);

            Order::where('id', $id)->update([
                'status_order' => 'Finished'
            ]);
        }

        return redirect()->back();
    }

    public function cashPay(Request $request, $id)
    {
        $payTotal = $request->input('payTotal');

        $orders = Order::where('id', $id)->get();

        foreach ($orders as $order) {
            $invoice = Invoice::where('id', $order->invoice_id)->get();
            foreach ($invoice as $item) {
                $total = $payTotal - $item->total;

                Invoice::where('id', $order->invoice_id)
                    ->update([
                        'payTotal' => $payTotal,
                        'PayBack' => $total,
                        'status' => 'Settlement'
                    ]);
            }

            Customer::where('id', $order->table_id)->update([
                'status' => 'Free'
            ]);

            Order::where('id', $id)->update([
                'status_order' => 'Finished'
            ]);
        }

        return redirect()->back();
    }
}
