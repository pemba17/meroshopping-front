<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\WishList;
use Cookie;

class SingleProductController extends Controller
{
    public function index($slug){
        $product=Product::with('retailer')->where('urlname',$slug)
                          ->first();

        $related_products=Product::where('categoryId',$product->categoryId)
                            ->take(6)
                            ->get();         
        if($product){
            $product_images=explode(',',$product->filename);                  
            return view('single-product',compact('product','product_images','related_products'));
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
}
