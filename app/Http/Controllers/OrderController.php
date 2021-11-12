<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Cookie;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Product;
use App\Models\TempData;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderController extends Controller
{
    public function save(Request $request){

        $data=json_decode($request->post('details'),true);
        $total_amount=$data['amount']-$data['discount']-$data['delivery_charge'];
        $order=Order::addOrder($data,'COD',$total_amount);
        if($order->id){
            Mail::to($data['email'])->send(new OrderMail($data,$order));
            TempData::destroy($request->post('temp_id'));
            session()->flash('success','Thank You. Your Order Has Been Received');
            session()->flash('order_id',$order->id);
            return redirect()->to('/order-received');
        } 
    }
}
