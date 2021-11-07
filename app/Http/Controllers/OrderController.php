<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Cookie;

class OrderController extends Controller
{
    public function save(Request $request){
        Order::create([
            'product_id'=>$request->post('product_id'),
            'amount'=>$request->post('amount'),
            'cart_id'=>$request->post('cart_id'),
            'client_type'=>Auth::check()?'registered':'guest',
            'client_id'=>Auth::check()?auth()->user()->id:NULL,
            'checkout_id'=>$request->post('checkout_id'),
            'quantity'=>$request->post('quantity'),
            'payment_type'=>$request->post('payment_type')
        ]) ; 

        return redirect()->to('/order-detail')->with('success','Order Completed');
    }
}
