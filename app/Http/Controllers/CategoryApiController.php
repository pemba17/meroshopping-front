<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function getCategories()
    {
        $categories=Category::select('id','parentId','title','urltitle','image','position','icon','showInMain')->whereNull('parentId')->orderBy('position','asc')->get();
        if($categories){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['error'=>'No Categories Found']);
        }
    }

    public function getFetCategories()
    {
        $categories=Category::select('id','parentId','title','urltitle','image','position','showInMain')->where('showInHighlighted',1)->take(6)->whereNull('parentId')->orderBy('position','asc')->get();
        if($categories){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['error'=>'No Categories Found']);
        }
    }

    // get products according to categries with category id
    public function getCategoryProducts(Request $request)
    {
        $categories = Product::where('categoryId',$request->id)->get();

        if($categories){
            return response()->json(['data'=>$categories]);
        }
        else{
            return response()->json(['error'=>'No Categories Found']);
        }
    }

    // get products according to brands with brandId
    public function getBrandProducts(Request $request)
    {
        $brands = Product::where('brandId',$request->id)->get();
        if($brands){
            return response()->json(['data'=>$brands]);
        }else{
            return response()->json(['error'=>'No Brands Found']);
        }
    }

    // get products according to tags with tagId
    public function getTagsProduct(Request $request)
    {
        $tag=Tag::find($request->id);
        $product_tags=ProductTag::where('tagId',$tag->id)->pluck('productId')->toArray();
        $tagproducts=Product::whereIn('id',$product_tags)->get();
        if($tagproducts){
            return response()->json(['data'=>$tagproducts]);
        }else{
            return response()->json(['error'=>'No Tags Found']);
        }

    }

    // 
}
