<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nabil;
use Illuminate\Support\Facades\Http;
use App\Models\TempData;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use DB;

class NabilController extends Controller
{
    public function index(Request $request){      
        if($request->post()){
            $amt=$request->amount*100;
            $nabil=Nabil::make_request($amt,$request->productID);
            $response = Nabil::sendRequest($nabil,'testing'); 
            $fpResponse = fopen("nabil/response.log", "w");
            fwrite($fpResponse, date('Y-m-d H:i:s') . "\n" . $response . "\n\n");
            fclose($fpResponse);

            $data = simplexml_load_string($response);
            $data=  json_decode(json_encode($data));
            $operation = $data->Response->Operation;
            $status = $data->Response->Status;
            $order_id = $data->Response->Order->OrderID;
            $session_id = $data->Response->Order->SessionID;
            $url = $data->Response->Order->URL;

            $arr=[
                'status'=>$status,
                'data'=>$data,
                'amount'=>$amt,
                'url'=>$url
            ];
            return response()->json(['success'=>$arr]); // we get url to nabil portal
        }
    }

    public function cancel(Request $request){
        $fpRequest = fopen(public_path().'/nabil/cancelresponse.log', "w");
		fwrite($fpRequest, date('Y-m-d H:i:s') . "\n" . $request . "\n\n");
		fclose($fpRequest);

        // check if user id exists
        if($request->id!="false"){
            Auth::loginUsingId($request->id);
        }
        return redirect()->to('payment/fail')->with('errorMessage','Your transaction has failed. Please go back and try again.');
    }

    public function approve(Request $request){
       $xml=$request->post('xmlmsg');
       $fpPaymentResponse = fopen(public_path().'/nabil/paymentresponse.log', "w");
       fwrite($fpPaymentResponse, date('Y-m-d H:i:s') . "\n" . $xml . "\n");
       fclose($fpPaymentResponse);

       $xml = '<?xml version="1.0" encoding="UTF-8"?>' . $xml;
       $data = simplexml_load_string($xml);

        if($data==false){
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        }else{
            $data=json_decode(json_encode($data));
            $orderId=$data->OrderID;
            $sessionId=$data->SessionId;
            $temp_order_id=trim(explode(':',$data->OrderDescription)[1]);
            $total_amount = $data->PurchaseAmount;

            $statusRequest = '<?xml version="1.0" encoding="UTF-8"?>
							<TKKPG>
                                <Request>
                                    <Operation>GetOrderStatus</Operation>
                                    <Language>EN</Language>
                                    <Order>
                                        <Merchant>' .'NABIL106508'. '</Merchant>
                                        <OrderID>' . $orderId . '</OrderID>
                                    </Order>
                                    <SessionID>' . $sessionId .'</SessionID>
                                </Request>
			                </TKKPG>';

            $fpRequest = fopen(public_path().'/nabil/statusrequest.log', "w");
            fwrite($fpRequest, date('Y-m-d H:i:s') . "\n" . $statusRequest . "\n\n");
            fclose($fpRequest);

            $response = Nabil::sendRequest($statusRequest,'testing');

            $fpResponse = fopen(public_path().'/nabil/statusresponse.log', "w");
			fwrite($fpResponse, date('Y-m-d H:i:s') . "\n" . $response . "\n\n");
			fclose($fpResponse);

            $data = simplexml_load_string($response);
			$data = json_decode(json_encode($data));

            // now send temp order to order

            if($data->Response->Order->OrderStatus="APPROVED"){
                $temp=TempData::where('id',$temp_order_id)->pluck('data')->first();
                $temp_data=json_decode($temp,true);
                $order=Order::addOrder($temp_data,'Nabil',$total_amount);
                if($order->id){
                    // Mail::to($data['email'])->send(new OrderMail($data,$order));
                    session()->flash('success','Thank You. Your Order Has Been Received');
                    session()->flash('order_id',$order->id);
                    TempData::destroy($request->oid);
                    DB::table('payment_response')->insert([
                        'response'=>json_encode($data),
                        'created_at'=>date('Y-m-d'),
                        'updated_at'=>date('Y-m-d'),
                        'source'=>'Nabil'
                    ]);
                    return redirect()->to('/order-received');
                }
            }else{
                dd('Failed');
            } 
        }
    }

    public function decline(Request $request){
        $fpRequest = fopen(public_path().'/nabil/declineresponse.log', "w");
		fwrite($fpRequest, date('Y-m-d H:i:s') . "\n" . $request . "\n\n");
		fclose($fpRequest);

        if($request->id!="false"){
            Auth::loginUsingId($request->id);
        }
        return redirect()->to('payment/fail')->with('errorMessage','Your Card Has Been Declined. Please Try Again');
    }
}
