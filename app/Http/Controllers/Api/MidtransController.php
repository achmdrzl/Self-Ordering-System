<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function validationPayment(Request $request)
    {
        $data = json_decode($request->getContent());
        $signature_key = hash('sha512', $data->order_id . $data->status_code . $data->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if($signature_key != $data->signature_key){
            return abort(404);
        }

        // Status Berhasil
        // Find Data by Order Code
        $order = Order::where('orderCode', $data->order_id)->first();
        
        // Find Invoice by Relationship Invoice ID
        $invoice = Invoice::where('id', $order->invoice_id)->first();
        
        // Update Status Table
        if($data->transaction_status === 'settlement'){
            $customer = Customer::where('no_table', $order->table_id)->first();
            $customer->update([
                'status' => 'Free'
            ]);
        }
        
        // Update Payment Status
        return $invoice->update([
            'status' => $data->transaction_status
        ]);
    }
}
