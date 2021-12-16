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
use App\Models\Khalti;
use DB;

class OrderController extends Controller
{
    public function save(Request $request){

        $data=json_decode($request->post('details'),true);
        $total_amount=$data['amount']-$data['discount']+$data['delivery_charge'];
        $order=Order::addOrder($data,'COD',$total_amount);
        if($order->id){
            Mail::to($data['email'])->send(new OrderMail($data,$order));
            TempData::destroy($request->post('temp_id'));
            session()->flash('success','Thank You. Your Order Has Been Received');
            session()->flash('order_id',$order->id);
            return redirect()->to('/order-received');
        } 
    }

    public function khalti(Request $request){
        $payment_data=json_decode($request->payment_data);
        $khalti_response=Khalti::verifyPayment($payment_data,$request->amount*100);
        if((!isset($khalti_response->error_key))&&(strtolower($khalti_response->state->name)=="completed")){
            $temp=TempData::where('id',$khalti_response->product_identity)->pluck('data')->first();
            $data=json_decode($temp,true);
            $total_amount=$khalti_response->amount/100;
            $order=Order::addOrder($data,'Khalti',$total_amount);
            if($order->id){
                Mail::to($data['email'])->send(new OrderMail($data,$order));
                session()->flash('success','Thank You. Your Order Has Been Received');
                session()->flash('order_id',$order->id);
                TempData::destroy($request->oid);
                DB::table('payment_response')->insert([
                    'response'=>json_encode($khalti_response),
                    'created_at'=>date('Y-m-d'),
                    'updated_at'=>date('Y-m-d')
                ]);
                return redirect()->to('/order-received');
            }
        }else{
            echo "Something went wrong. Please Contact The Administrator";
        }
    }
}
