<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class SingleProductController extends Controller
{
    public function index(){
        return view('single-product');
    }

    public function store(Request $request) // add to cart
    {
        $stock=Product::where('id',1)->pluck('stock')->first();
        $request->validate([
            'quantity'=>['required','numeric','min:1','max:'.$stock]
        ]);

        if(Auth::check()){
            $data=Cart::where('product_id',$request->post('product_id'))
                    ->where('client_id',auth()->user()->id)
                    ->first();
            if($data){
                $data->update([
                    'quantity'=>$data->quantity+$request->post('quantity')
                ]);
            }else{
                Cart::create([
                    'product_id'=>$request->post('product_id'),
                    'client_id'=>auth()->user()->id,
                    'quantity'=>$request->post('quantity')
                ]);
            }     
            session()->flash('success','Product Added To Cart Successfully');
            return redirect()->to('/product');

        }else{
            return redirect()->route('login');
        }
    }
}
