<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $customer = Customer::findOrFail($no_table);

        $customer->status = 'Check-In';

        $customer->save();

        if(Cart::total() == 0){
            return redirect()->route('checkout.show');
        }else{
            // Insert Invoice Data
            $invoice = $customer->invoice()->create([
                'payMethod' => $payMethod,
                'total' => Cart::totalFloat(),
            ]);
    
            // Insert Order Data  
            $string = Str::random(4);
            $code = ($string . rand(10, 100));
            $order = $customer->orders()->create([
                'total' => Cart::totalFloat(),
                'payMethod' => $payMethod,
                'orderCode' => $code,
                'invoice_id' => $invoice->id
            ]);

            // Place Order
            $order_products = [];
            foreach (Cart::content() as $cartData) {
                $order_products[] = [
                    'order_id' => $order->id,
                    'product_id' => $cartData->id,
                    'quantity' => $cartData->qty,
                    'total_price' => $cartData->qty * $cartData->price,
                ];
            }
    
            OrderProduct::insert($order_products);
    
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
    //     return $this->belongsTo(Product::class);
    // }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
