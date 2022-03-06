<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\WishList;
use App\Models\BestSeller;
use Cookie;
use App\Models\ProductReview;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\SizeProduct;
use App\Models\ColorProduct;
use App\Models\ProductQuestion;
use DB;

class SingleProductController extends Controller
{
    public function index($slug){
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

            if(Auth::check()) {
                $my_questions=ProductQuestion::with('client')->where('product_id',$product->id)->where('client_id',auth()->user()->id)->get();
                $other_questions=ProductQuestion::with('client')->where('product_id',$product->id)->where('client_id','!=',auth()->user()->id)->get();
            }
            else {
                $my_questions=collect([]);
                $other_questions=ProductQuestion::with('client')->where('product_id',$product->id)->get();
            }
            return view('single-product',compact('product','product_images','related_products','best_sellers','product_cat','second_parent','first_parent','count_reviews','total_rating','sizes','colors','my_questions','other_questions','per_count_reviews','user_reviews','vendor_name'));
        }
        else
        abort(404);
    }

    public function store(Request $request,$type) // add to cart
    {


        // if($request-check>size && $request->color==null){
        //     $stock=SizeProduct::where('product_id',$request->product_id)->where('size_id',$request->size)->pluck('stock')->first();
        // }elseif($request->color && $request->size==null){
        //     $stock=ColorProduct::where('product_id',$request->product_id)->where('color_id',$request->color)->pluck('stock')->first();
        // }else{
        //     $stock=Product::where('id',$request->post('product_id'))->pluck('stock')->first();
        // }

        // $hotstock=Product::where('id',$request->post('product_id'))->pluck('hot_deal')->first();
        // if(!($hotstock)){
            $request->validate([
                'quantity'=>['required','numeric','min:1']
            ]);
        // }
        Cart::addCart($request->post('product_id'),$request->post('quantity'),$request->color,$request->size);

        if($type=='buy'){
            return redirect()->to('checkout');
        }else{
            session()->flash('success','Product Added To Cart Successfully');
            session()->flash('color','success');
            return redirect()->back();
        }
    }

    public function addToWishList($id){
        $output=WishList::addWishList($id);
        if($output==true) return redirect()->to('wishlist')->with('success','Product Added To Wishlist Successfully');
        else return redirect()->to('login');
    }

    public function addToCart($product_id,$quantity=1){
        $output=Cart::addCart($product_id,$quantity);
        if($output) {session()->flash('color','success');return redirect()->to('cart')->with('success','Product Added To Cart Successfully');}
    }

    public function addReview(Request $request){

        $request->validate([
            'rating'=>['required'],
            'comment'=>['required','string','max:255']
        ]);
        ProductReview::updateOrCreate([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->product_id
        ],[
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->product_id,
            'comment'=>$request->comment,
            'rating'=>$request->rating
        ]);

        session()->flash('success','Thank You For The Review');
        session()->flash('color','success');
        return redirect()->back();
    }

    public function postQuestion(Request $request){
        $request->validate([
            'question'=>['required','string','max:300']
        ]);

        ProductQuestion::create([
            'product_id'=>$request->product_id,
            'vendor_id'=>$request->vendor_id,
            'question'=>$request->question
        ]);

        session()->flash('success','Thank You For Question');
        session()->flash('color','success');
        return redirect()->back();
    }
}
