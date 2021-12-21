<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    public $name,$perPage=6,$sort;

    public function getTopSoldProducts(){
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        if($hot_deal_products){
            return response()->json(['data'=>$hot_deal_products]);
        }else{
            return response()->json(['error'=>'No Hot Deals Found']);
        }

    }
    public function getSingleProduct(Request $request){
        
    }

    public function search(Request $request){
        $products=Product::when($request->name,function($q,$name){
            $q->where('name','LIKE','%'.$name.'%');
        })->when($request->sort,function($q,$sort){
            if($sort=='Low To High') $q->orderBy('price','asc');
            else $q->orderBy('price','desc');
        })->paginate($this->perPage);

        if($products){
            return response()->json(['data'=>$products]);
        }else{
            return response()->json(['message'=>'No Results Found']);
        }
    }
}
