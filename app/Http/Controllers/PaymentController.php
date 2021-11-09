<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $json_data=session()->get('info');
        $data=json_decode($json_data,true);
        $arr=[
            'name'=>$data['name'],
            'address'=>$data['address'],
            'email'=>$data['email'],
            'contact'=>$data['contact'],
            'city'=>$data['city'],
            'state'=>$data['state'],
            'comments'=>$data['comments'],
            'cart_id'=>implode(',',array_column($data['cart'],'id')),
            'product_id'=>implode(',',array_column($data['cart'],'product_id')),
            'quantity'=>implode(',',array_column($data['cart'],'quantity')),

        ];
        if($data){
            return view('payment',compact('json_data','data','arr'));
        }else{
            abort(403);
        }    
    }
}
