<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $product_cat=null;
        $second_parent=null;
        $first_parent=null;
        $product=Product::with('retailer')->where('urlname',$slug)->first();
        if($product){
            $selected_sizes=explode(',',$product->sizeIds);
            if(count($selected_sizes)>0){
                $sizes=Size::select('sizes.id as id','name','stock')
                            ->leftJoin('size_products','sizes.id','size_products.size_id')
                            ->whereIn('sizes.id',$selected_sizes)
                            ->where('stock','>',0)
                            ->where('product_id',$product->id)
                            ->get();

            }else $sizes=collect([]);
            $selected_colors=explode(',',$product->colorIds);
            if(count($selected_colors)>0){
                $colors=Color::select('colors.id as id','name','stock','color_code')
                            ->leftJoin('color_products','colors.id','color_products.color_id')
                            ->whereIn('colors.id',$selected_colors)
                            ->where('stock','>',0)
                            ->where('product_id',$product->id)
                            ->get();

            }else $colors=collect([]);

            $product_cat=Category::select('id','parentId','title','urltitle')->where('id',$product->categoryId)->first();
            if($product_cat){
                $second_parent=Category::select('id','parentId','title','urltitle')->where('id',$product_cat->parentId)->first();
                if($second_parent) $first_parent=Category::select('id','parentId','title','urltitle')->where('id',$second_parent->parentId)->first();
            }

            return $product;
        }
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
