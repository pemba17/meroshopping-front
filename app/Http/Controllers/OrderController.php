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
        $order=Order::create([
            'amount'=>$request->post('amount'),
            'client_type'=>Auth::check()?'registered':'guest',
            'client_id'=>Auth::check()?auth()->user()->id:NULL,
            'payment_type'=>$request->post('payment_type'),
            'name'=>$request->post('name'),
            'address'=>$request->post('address'),
            'email'=>$request->post('email'),
            'contact'=>$request->post('contact'),
            'city'=>$request->post('city'),
            'state'=>$request->post('state'),
            'comments'=>$request->post('comments'),
            'order_status'=>'new_order',
            'discount'=>$request->post('discount'),
            'delivery_charge'=>$request->post('delivery_charge'),
            'total_amount'=>$request->post('amount')-$request->post('discount')-$request->post('delivery_charge')
        ]);
        
        $products=explode(',',$request->post('product_id'));
        $quantity=explode(',',$request->post('quantity'));
        $carts=explode(',',$request->post('cart_id'));

        foreach($products as $key=>$row){
            $order_product[]=OrderProduct::create([
                'product_id'=>$row,
                'quantity'=>$quantity[$key],
                'order_id'=>$order->id
            ]);

            $stock=Product::where('id',$row)->pluck('stock')->first();

            Product::where('id',$row)->update(['stock'=>$stock-$quantity[$key]]);

        }

        foreach($carts as $row){
            Cart::destroy($row);
        }




        session()->flash('success','Thank You. Your Order Has Been Received');
        session()->flash('order_id',$order->id);
        return redirect()->to('/order-received');
    }
}
