<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function getCategories(){
        $categories=Category::select('id','parentId','title','urltitle','image','position','icon','showInMain')->whereNull('parentId')->orderBy('position','asc')->get();
        if($categories){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['error'=>'No Categories Found']);
        }
    }

    public function getFetCategories(){
        $categories=Category::select('id','parentId','title','urltitle','image','position','showInMain')->where('showInHighlighted',1)->take(6)->whereNull('parentId')->orderBy('position','asc')->get();
        if($categories){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['error'=>'No Categories Found']);
        }
    }

    public function getProducts(Request $request){
        $products = Product::where('categoryId',$request->id)->get();
        if($products){
            return response()->json(['data'=>$products]);
        }
        else{
            return response()->json(['error'=>'No Products Found']);
        }
    }
}
