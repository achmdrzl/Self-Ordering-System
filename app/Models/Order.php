<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function createOrder($payMethod)
    {
        $no_table = request()->session()->get('no_table');

        // Insert table_id & Status
        $customer = Customer::where('no_table', $no_table)->first();

        $customer->status = 'Check-In';

        $customer->save();

        if (Cart::total() == 0) {

            return redirect()->route('checkout.show');
        } else {

            // Check if there are any unfinished orders
            $datas = Order::where('table_id', $no_table)->get();
            $data = $datas->whereNotIn('status_order', 'Finished')->count();
            $available = $datas->whereNotIn('status_order', 'Finished');

            if ($data == 0) {

                // Insert Invoice Data
                $invoice = $customer->invoice()->create([
                    'payMethod' => $payMethod,
                    'total' => Cart::totalFloat(),
                ]);

                // Insert Order Data  
                $string = Str::random(4);
                $code = ($string . rand(10, 100));
                $order = Order::create([
                    'total' => Cart::totalFloat(),
                    'payMethod' => $payMethod,
                    'orderCode' => $code,
                    'invoice_id' => $invoice->id,
                    'table_id' => $customer->no_table
                ]);

                // Minus Stock Product

                // Validate Qty
                #code


                // Place Order
                $order_products = [];
                foreach (Cart::content() as $cartData) {

                    // Minus Stock
                    $finalStock = [];
                    $qty = $cartData->qty;
                    $products = Product::find($cartData->id);
                    $data = $products->stock - $qty;
                    $products->where('id', $cartData->id)->update(['stock' => $data]);

                    // Insert to Detail Order
                    $order_products[] = [
                        'order_id' => $order->id,
                        'product_id' => $cartData->id,
                        'quantity' => $cartData->qty,
                        'total_price' => $cartData->qty * $cartData->price,
                    ];
                }

                OrderProduct::insert($order_products);
            } else {

                foreach ($available as $item) {
                    // Update Invoice
                    $repeatInvoice = Invoice::where('id', $item->invoice_id)->update([
                        'total' => $available->sum('total') + Cart::totalFloat(),
                    ]);

                    // Update Order
                    $repeatOrder = Order::where('id', $item->id)->update([
                        'total' => $available->sum('total') + Cart::totalFloat(),
                        'status_order' => 'Waiting'
                    ]);

                    // Insert Order Product
                    $order_products = [];
                    foreach (Cart::content() as $cartData) {
                        $order_products[] = [
                            'order_id' => $item->id,
                            'product_id' => $cartData->id,
                            'quantity' => $cartData->qty,
                            'total_price' => $cartData->qty * $cartData->price,
                        ];
                    }

                    OrderProduct::insert($order_products);
                }
            }

            Cart::destroy();
        }

        // $order->orderCols()->attach(1);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class);
    // }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
