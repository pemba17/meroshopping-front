<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    public function getTopSoldProducts(){
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        if($hot_deal_products){
            return response()->json(['data'=>$hot_deal_products]);
        }else{
            return response()->json(['error'=>'No Hot Deals Found']);
        }

    }
}
