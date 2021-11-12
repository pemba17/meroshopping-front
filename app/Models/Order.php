<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $guarded=[];
    use HasFactory;

    public static function addOrder($data,$payment_type,$total_amount){
        $order=Order::create([
            'amount'=>$data['amount'],
            'client_type'=>Auth::check()?'registered':'guest',
            'client_id'=>Auth::check()?auth()->user()->id:NULL,
            'payment_type'=>$payment_type,
            'name'=>$data['name'],
            'address'=>$data['address'],
            'email'=>$data['email'],
            'contact'=>$data['contact'],
            'city'=>$data['city'],
            'state'=>$data['state'],
            'comments'=>$data['comments'],
            'order_status'=>'new_order',
            'discount'=>($data['discount']==null)?0:$data['discount'],
            'delivery_charge'=>$data['delivery_charge'],
            'total_amount'=>$total_amount
        ]);

        foreach($data['cart'] as $key=>$row){
            $order_product[]=OrderProduct::create([
                'product_id'=>$row['product_id'],
                'quantity'=>$row['quantity'],
                'order_id'=>$order->id
            ]);
            $stock=Product::where('id',$row['product_id'])->pluck('stock')->first();
            Product::where('id',$row['product_id'])->update(['stock'=>$stock-$row['quantity']]);    
        }

        foreach($data['cart'] as $row){
            Cart::destroy($row['id']);
        }

        return $order;
    }
}
