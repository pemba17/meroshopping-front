<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Coupon;
use App\Models\DeliveryArea;
use App\Models\DeliveryCity;
use App\Models\DeliveryRegion;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ShippingTime;
use App\Models\Size;
use App\Models\SizeProduct;
use App\Models\TempData;
use App\Models\User;
use App\Models\WishList as WishLists;
use App\Models\WishList;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


class ProductApiController extends Controller
{


    public $name,$perPage=6,$sort,$carts;
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
                'vendor_name'=>empty($vendor_name)?'null':$vendor_name

            ]);
        }
    }
    // searcing products
    public function search(Request $request)
    {
        $products=Product::where('name',$request->get('productName'),function($q,$name){
            $q->where('name','LIKE','%'.$name.'%');
        })->paginate(20);
        // ->where($request->sort,function($q,$sort){
        //     if($sort=='Low To High') $q->orderBy('price','asc');
        //     else $q->orderBy('price','desc');
        // })

        if($products){
            return response()->json(['data'=>$products]);
        }else{
            return response()->json(['message'=>'No Results Found']);
        }
    }

      // add wishlist products
      public function addToWishList(Request $request)
      {
          $wishlist=WishList::addWishList($request->wishlist_id);
          if($wishlist){
              return response()->json([
                  'Message'=>'Added item to Wishlists'
              ]);
          }else{
              return response()->json([
                  'error'=>'Error while adding to Wishlist'
              ]);
          }


      }
    // get whilst products
    public function getWhilstProducts(Request $request)
    {
        $wishlist=WishLists::with('product')->where('client_id',auth()->user()->id)->get();
        if(!empty($wishlist)){
                return response()->json(['data'=>$wishlist]);
            }else{
                return response()->json(['error'=>'No Products on WishLists']);
            }
    }
    //remove item form wishlists
    public function removeWishList(Request $request)
    {
        $client_id=User::find(auth()->user()->id)->id;
        $wishlist=WishList::where('id',$request->wishlist_id)->where('client_id',$client_id)->first();
        if($wishlist){
            $wishlist->delete();
            return response()->json(['message'=>'Items Removed From WishList']);
        }else{
            return response()->json(['message'=>'No Items matched in WishLists']);
        }
    }
    // Items Added to Cart from Home Page
    public function addToCart(Request $request)
    {
        $client_id=User::find(auth()->user()->id)->id;


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
                    'client_id'=>$client_id,
                    'quantity'=>$request->quantity,
                    'color_id'=>$request->color_id,
                    'size_id'=>$request->size_id
                ]);
        }
       return response()->json(['message'=>"Products Added to Cart Successfully"]);
    }
    // get Added Items From Cart
    public function getItemsFromAddToCart(Request $request)
    {
        $client_id=User::find(auth()->user()->id)->id;
        $cart_items=Cart::select('products.name as p_name','products.filename as image','sizes.name as s_name','colors.name as color_name','quantity','code','mrp','pricetag','price','discount','unit_id','color_code','size_id','carts.id as c_id')->join('products','products.id','carts.product_id',)->leftjoin('colors','colors.id','carts.color_id')->leftjoin('sizes','size_id','sizes.id')->where('client_id',$client_id)->get();

        if(!empty($cart_items)){
            return response()->json([
                "cart_items"=>$cart_items,
            ]);
        }else{
            return response()->json(["message"=>"No Items added in Cart"]);
        }
    }
    public function updateCart(Request $request)
    {
        $client_id=User::find(auth()->user()->id)->id;
        $cart=Cart::where('id',$request->cart_id)->where('client_id',$client_id)->first();
        if($cart){
            $totalquantity=$cart->quantity+$request->quantity;
            if($cart->product_id){
                $availablestock=Product::where('id',$cart->product_id)->pluck('stock')->first();

                if($request->color && $request->size==null)
                    $availablestock=ColorProduct::where('product_id',$cart->product_id)->where('color_id',$request->color)->pluck('stock')->first();
                elseif($request->size && $request->color==null)
                $availablestock=SizeProduct::where('product_id',$cart->product_id)->where('size_id',$request->size)->pluck('stock')->first();
            }
            Validator::make($request->all(),[
                'quantity'=>['required','numeric','min:1','max:'.$availablestock],

            ]);
            $updatedcart=Cart::updateCart($request->cart_id,$request->quantity);
        }else{
            return response()->json(['message'=>'Items Not Found in Cart']);
        }

        $cart=Cart::where('id',$request->cart_id)->where('client_id',$client_id)->first();
        if($updatedcart){
            return response()->json([
                'message'=>'Updated Successfully',
                'data'=>$cart
            ]);
        }
    }
    // Remove From Cart
    public static function removeCart(Request $request)
    {
        $client_id=User::find(auth()->user()->id)->id;
        $cart=Cart::where('id',$request->cart_id)->where('client_id',$client_id)->first();
        if($cart){
            $cart->delete();
            return response()->json(['message'=>'Cart Items Removed Successfully']);
        }else{
            return response()->json(['message'=>'No Items Found On Cart']);
        }
    }

    // checkout
    public function viewCheckOut()
    {
        $client_id=User::find(auth()->user()->id)->id;
        $carts=Cart::with('product')->where('client_id',$client_id)->get()->toArray();
        if(empty($carts)){
            return response()->json(['message'=>'No Items Added In Cart']);
        }
        $regions=DeliveryRegion::get();
        $shipping_time=ShippingTime::get();
        // $cities=DeliveryCity::get();
        // $areas=DeliveryArea::get();
        $coupons=Coupon::get();
        return response()->json([
            'cart_items'=>$carts,
            'regions'=>$regions,
            'shipping_time'=>$shipping_time,
            'coupons'=>$coupons

        ]);
    }
    // get cities
    public function getCity(Request $request){
        $para=$request->get('region_id');
        $city=DeliveryCity::where('region_id',$para)->get();
        if($city){
            return response()->json([
                'city'=>$city
            ]);
        }else{
            return response()->json([
                'message'=>'No data Found'
            ]);
        }

    }
    public function getArea(Request $request){
        $area=DeliveryArea::where('city_id',$request->get('city_id'))->get();
        return response()->json([
            'area'=>$area,

        ]);
    }
    public function getCoupon(Request $request){
        $coupon=Coupon::where('coupon_code',$request->coupon_code)->where('exp_date')->first();
        if($coupon){

        }else{

        }
    }

    public function orderHistory(){
        $client_id=User::find(auth()->user()->id)->id;
        $orderhistory=Order::with('product','orderProduct')->where('client_id',$client_id)->get();
        if(count($orderhistory)>0){
            return response()->json([
                "message"=>'successful',
                "orderhistory"=>$orderhistory
            ]);
        }else{
            return response()->json([
                "message"=>"No Records Found."
            ]);
        }
    }
    // checkout
    public function checkOut(Request $request)
    {
        Validator::make($request->all(),[
            'state'=>['required'],
            'city'=>($request->state!=null || $request->state!="")?['required']:[],
            'city_area'=>($request->city!=null || $request->city!="")?['nullable']:[],
            'shipping_time'=>['required']
        ]);
        $client_info=User::find(auth()->user()->id);
        $carts=Cart::with('product')->where('client_id',$client_info->id)->get()->toArray();
        if(count($carts)<1){
            return response()->json(['message'=>'empty cart item']);
        };
        $info=[
            'name'=>$client_info->name,
            'address'=>$client_info->address,
            'email'=>$client_info->email,
            'contact'=>$client_info->contact,
            'city'=>$request->city,
            'state'=>$request->state,
            'comments'=>$request->comments,
            'cart'=>$carts,
            'amount'=>$request->amount,
            'discount'=>$request->discount,
            'delivery_charge'=>$request->delivery_charge,
            'total_amount'=>$request->total_sum-$request->discount+$request->delivery_charge,
            'area'=>$request->city_area,
            'shipping_time'=>$request->shipping_time
        ];
        if($info){
            $data=json_encode($info);
            $temp=TempData::create([
                'data'=>$data
            ]);
            if($temp){
                return response()->json([
                    "temp_id"=>$temp->id,
                    "message"=>'success',
                ]);
            }else{
                return response()->json([
                    'message'=>'error in checking out',
                ]);
            }

        }

    }

    public function paymentType(Request $request)
    {
        $tempdata=TempData::where('id',$request->temp_id)->pluck('data')->first();
        $data=json_decode($tempdata,true);
        $total_amount=$data['amount']-$data['discount']+$data['delivery_charge'];
        if(($request->payment_type)=="COD")
        {
            $order=Order::addOrder($data,'COD',$total_amount);
            if($order->id){
                TempData::destroy($request->temp_id);
                return response()->json([
                    "message"=>"Order Successful"
                ]);
            }else{
                return response()->json([
                    "message"=>"Error in Processing Ordering",
                ]);
            }
        }
        if(($request->payment_type)=="Esewa")
        {
            if($request->oid && $request->amt && $request->refId){
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
                        TempData::destroy($request->oid);
                        return response()->json([
                            "message"=>"Order Successful"
                        ]);
                        }else{
                            return response()->json([
                                "message"=>"Your transaction has failed. Please go back and try again.",
                            ]);
                        }

                    }
                }
        }
        if(($request->payment_type)=="COD"){

        }
    }

    }




// public function addToWishList($product_id){
//     $output=WishList::addWishList($product_id);
//     if($output==true) return redirect()->to('wishlist')->with('success','Product Added To Wishlist Successfully');
//     else return redirect()->to('login');
// }
