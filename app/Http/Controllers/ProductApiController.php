<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Size;
use App\Models\WishList as WishLists;
use App\Models\WishList;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductApiController extends Controller
{


    public $name,$perPage=6,$sort;
    // getting top sold products
    public function getTopSoldProducts()
    {
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        if($hot_deal_products){
            return response()->json(['data'=>$hot_deal_products]);
        }else{
            return response()->json(['error'=>'No Hot Deals Found']);
        }

    }
    // getting single products
    public function getSingleProduct(Request $request)
    {
        $product_cat=null;
        $second_parent=null;
        $first_parent=null;
        $product=Product::with('retailer')->where('urlname',$request->slug)->first();
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
            $related_products=Product::where('categoryId',$product->categoryId)
            ->whereNotIn('id',array($product->id))
            ->take(6)
            ->get();

            $best_sellers=BestSeller::leftJoin('retailers','best_sellers.retailer_id','retailers.id')
                            ->leftJoin('users','retailers.id','users.retailer_id')
                            ->orderBy('position','asc')->take(5)->get();

            $count_reviews=ProductReview::where('product_id',$product->id)->count();

            $per_count_reviews=ProductReview::select('rating',DB::raw('COUNT(rating) AS count'))->where('product_id',$product->id)->groupBy('rating')->get();

            $total_rating=ProductReview::where('product_id',$product->id)->sum('rating');

            $user_reviews=ProductReview::with('client')->where('product_id',$product->id)->get();

            $product_images=explode(',',$product->filename);

            $vendor_name=DB::table('users')->where('retailer_id',$product->retailerId)->first();


            // if(Auth::check()) {
            // $my_questions=ProductQuestion::with('client')->where('product_id',$product->id)->where('client_id',auth()->user()->id)->get();
            // $other_questions=ProductQuestion::with('client')->where('product_id',$product->id)->where('client_id','!=',auth()->user()->id)->get();
            // }
            // else {
            // $my_questions=collect([]);
            // $other_questions=ProductQuestion::with('client')->where('product_id',$product->id)->get();
            // }

            return response()->json([
                'data'=>$product,
                'sizes'=>$sizes,
                'color'=>$colors,
                'category'=>$product_cat,
                'secondparent'=>$second_parent,
                'firstparent'=>$first_parent,
                'relatedproducts'=>$related_products,
                'bestsellers'=>$best_sellers,
                'count_reviews'=>$count_reviews,
                'per_count_reviews'=>$per_count_reviews,
                'total_rating'=>$total_rating,
                'user_reviews'=>$user_reviews,
                'product_images'=>$product_images,
                'vendor_name'=>$vendor_name

            ]);
        }
    }
    // searcing products
    public function search(Request $request)
    {
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

    // get whilst products
    public function getWhilstProducts(Request $request)
    {
        $wishlist=WishLists::with('product')->where('client_id',auth()->user()->id)->get();
        if(empty($wishlist)){
                return response()->json(['data'=>$wishlist]);
            }else{
                return response()->json(['error'=>'No Products on WishLists']);
            }
    }

    // add wishlist products
    public function addToWishList(Request $request)
    {
        $wishlist=WishList::addWishList($request->id);
        if($wishlist){
            // $wishlist=WishLists::with('product')->where('client_id',auth()->user()->id)->get();
            return response()->json([
                'data'=>$wishlist
            ]);
        }else{
            return response()->json([
                'error'=>'Error while adding to Wishlist'
            ]);
        }


    }


    // Items Added to Cart from Home Page
    public function addToCart(Request $request)
    {
        $client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $data=Cart::where('product_id',$request->product_id)
                ->where('client_id',$client_id)
                ->first();
        if($data){
            $output=$data->update([
                'quantity'=>$data->quantity+$request->quantity
            ]);
        }else{
            $output=Cart::create([
                'product_id'=>$request->product_id,
                'client_id'=>$request->client_id,
                'quantity'=>$request->quantity,
            ]);
        }
        $cartdata=Cart::where('product_id',$request->product_id)
        ->where('client_id',$client_id)
        ->first();
       return response()->json(['message'=>"Products Added to Cart Successfully",'products'=>$cartdata]);
    }

    // Remove From Cart
    public static function removeCart(Request $request)
    {
        Cart::destroy($request->id);
        return response()->json('Cart Items Removed Successfully');
    }
    public function AddToCartFromDetails(Request $request)
    {
            $client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
            $data=Cart::where('product_id',$product_id)
                    ->where('client_id',$client_id)
                    ->first();
            if($data){
                $output=$data->update([
                    'quantity'=>$data->quantity+$quantity
                ]);
            }else{
                $output=Cart::create([
                    'product_id'=>$product_id,
                    'client_id'=>$client_id,
                    'quantity'=>$quantity,
                ]);
            }
            return $output;

    }
}



// public function addToWishList($product_id){
//     $output=WishList::addWishList($product_id);
//     if($output==true) return redirect()->to('wishlist')->with('success','Product Added To Wishlist Successfully');
//     else return redirect()->to('login');
// }
