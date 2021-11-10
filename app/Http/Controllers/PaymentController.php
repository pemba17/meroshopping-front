<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TempData;

class PaymentController extends Controller
{
    public function index(){
        $json_data=session()->get('info');
        if($json_data){
            $data=json_decode($json_data,true);
            $temp=TempData::create([
                'data'=>$json_data
            ]);
            $temp_id=$temp->id;
            return view('payment',compact('json_data','data','temp_id'));
        }else{
            abort(403);
        }    
    }

    public function fail(){
        $errorMessage=session()->get('errorMessage');
        if($errorMessage){
            return view('fail');
        }else{
            abort(403);
        }
    }
}
