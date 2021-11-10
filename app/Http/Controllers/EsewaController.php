<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TempData;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
class EsewaController extends Controller
{
    public function success(Request $request){
        if(isset($request->oid) && isset($request->amt) && isset($request->refId)){
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data =[
                'amt'=> $request->amt,
                'rid'=> $request->refId,
                'pid'=> $request->oid,
                'scd'=> 'EPAYTEST'
            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            $response_code=$this->get_xml_node_value('response_code',$response);
            if(trim($response_code)=='Success'){
                $temp=TempData::where('id',$request->oid)->pluck('data')->first();
                $data=json_decode($temp,true);
                $order=Order::addOrder($data,'Esewa',$request->amt);
                if($order->id){
                    Mail::to($data['email'])->send(new OrderMail($data,$order));
                    session()->flash('success','Thank You. Your Order Has Been Received');
                    session()->flash('order_id',$order->id);
                    TempData::destroy($request->oid);
                    return redirect()->to('/order-received');
                }
            }   
        }
    }

    public function fail(){
        return redirect()->to('payment/fail')->with('errorMessage','Your transaction has failed. Please go back and try again.');
    }

    public function get_xml_node_value($node, $xml) {
	    if ($xml == false) {
	        return false;
	    }
	    $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.'</'.$node.'>#s', $xml, $matches);
	    if ($found != false) {
	        return $matches[1];  
	    }	  
        return false;
	}
}
