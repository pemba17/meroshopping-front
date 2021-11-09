<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Cookie;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Product;

class OrderController extends Controller
{
    public function save(Request $request){

        $data=json_decode($request->post('details'),true);
        $order=Order::create([
            'amount'=>$data['amount'],
            'client_type'=>Auth::check()?'registered':'guest',
            'client_id'=>Auth::check()?auth()->user()->id:NULL,
            'payment_type'=>'COD',
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
            'total_amount'=>$data['amount']-$data['discount']-$data['delivery_charge']
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

        session()->flash('success','Thank You. Your Order Has Been Received');
        session()->flash('order_id',$order->id);
        return redirect()->to('/order-received');
    }
}
