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

class SingleProductController extends Controller
{
    public function index($slug){
        $product_cat=null;
        $second_parent=null;
        $first_parent=null;

        $product=Product::with('retailer')->where('urlname',$slug)
                          ->first();                        
        if($product){
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
            $total_rating=ProductReview::where('product_id',$product->id)->sum('rating');

            $product_images=explode(',',$product->filename);                  
            return view('single-product',compact('product','product_images','related_products','best_sellers','product_cat','second_parent','first_parent','count_reviews','total_rating'));
        } 
        else
        abort(404);
    }

    public function store(Request $request,$type) // add to cart
    {
        $stock=Product::where('id',$request->post('product_id'))->pluck('stock')->first();
        $request->validate([
            'quantity'=>['required','numeric','min:1','max:'.$stock]
        ]);

        Cart::addCart($request->post('product_id'),$request->post('quantity'));

        if($type=='buy'){
            return redirect()->to('checkout');
        }else{
            session()->flash('success','Product Added To Cart Successfully');
            session()->flash('color','success');
            return redirect()->to('product/'.$request->post('slug'));
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
}
