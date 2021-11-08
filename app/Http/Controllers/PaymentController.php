<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $data=session()->get('info');
        
        if($data){
            $carts=[
                'product_id'=>implode(',',array_column($data['cart'],'product_id')),
                'quantity'=>implode(',',array_column($data['cart'],'quantity')),
                'cart_id'=>implode(',',array_column($data['cart'],'id'))
            ];
            return view('payment',compact('data','carts'));
        }else{
            abort(403);
        }    
    }
}
