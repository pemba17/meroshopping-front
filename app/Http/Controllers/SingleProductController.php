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
                
        if($product){
            $product_images=explode(',',$product->filename);                  
            return view('single-product',compact('product','product_images'));
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

        $client_id=Auth::check()?auth()->user()->id:Cookie::get('device');

        $data=Cart::where('product_id',$request->post('product_id'))
                ->where('client_id',$client_id)
                ->first();
        if($data){
            $data->update([
                'quantity'=>$data->quantity+$request->post('quantity')
            ]);
        }else{
            Cart::create([
                'product_id'=>$request->post('product_id'),
                'client_id'=>$client_id,
                'quantity'=>$request->post('quantity')
            ]);
        }     

        if($type=='buy'){
            return redirect()->to('checkout');
        }else{
            session()->flash('success','Product Added To Cart Successfully');
            return redirect()->to('product/'.$request->post('slug'));
        }    
    }

    public function addToWishList($id){
        if(Auth::check()){
           $product=Product::findOrFail($id);
           if($product){
                WishList::updateOrCreate([
                    'product_id'=>$id,
                    'client_id'=>auth()->user()->id
                ],[
                    'product_id'=>$id,
                    'client_id'=>auth()->user()->id 
                ]);

                return redirect()->to('wishlist')->with('success','Product Added To Wishlist Successfully');
           }
        }else{
            return redirect()->to('login');
        }
    }
}
