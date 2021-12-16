<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TempData;
use App\Models\Product;

class PaymentController extends Controller
{
    public function index(){
        $json_data=session()->get('info');
        if($json_data){
            $data=json_decode($json_data,true);
            // product id, slug, name for kalti
            $product_id=array_column($data['cart'],'product_id');
            $product_slug=implode(',',Product::whereIn('id',$product_id)->pluck('urlname')->toArray());
            $product_name=implode(',',Product::whereIn('id',$product_id)->pluck('name')->toArray());

            $temp=TempData::create([
                'data'=>$json_data
            ]);
            $temp_id=$temp->id;
            return view('payment',compact('json_data','data','temp_id','product_slug','product_name'));
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
