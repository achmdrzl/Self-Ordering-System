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

        // update invoice
        $invoice->update([
            'status' => $data->transaction_status,
            'payTotal' => $invoice->total
        ]);

        // get data order
        $orders = Order::where(
            'id',
            $id
        )->get();

        foreach ($orders as $order) {

            if ($data->transaction_status === 'pending') {
                // update data order
                Order::where('id', $id)->update([
                    'status_order' => 'Pending'
                ]);
            } else {
                // update data customer if finished
                Customer::where('id', $order->table_id)->update([
                    'status' => 'Free'
                ]);

                // update data order
                Order::where('id', $id)->update([
                    'status_order' => 'Finished'
                ]);
            }
        }

        return redirect()->back();
    }

    public function cashPay(Request $request, $id)
    {
        $this->validate($request, [
            'payTotal' => 'required',
        ]);

        $payTotal = $request->input('payTotal');

        $orders = Order::where('id', $id)->get();

        foreach ($orders as $order) {
            $invoice = Invoice::where('id', $order->invoice_id)->get();
            foreach ($invoice as $item) {

                if ($item->total > $payTotal) {
                    Toastr::error('Nominal Tidak Mencukupi!', 'Error', ["progressBar" => true,]);
                    return redirect()->back()->with([
                        'message' => 'User Updated Successfully',
                        'type' => 'success',
                    ]);
                } else {
                    $total = $payTotal - $item->total;

                    Invoice::where('id', $order->invoice_id)
                        ->update([
                            'payTotal' => $payTotal,
                            'PayBack' => $total,
                            'status' => 'Settlement'
                        ]);
                }
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
