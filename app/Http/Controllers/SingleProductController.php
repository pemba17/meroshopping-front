<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class SingleProductController extends Controller
{
    public function index(){
        return view('single-product');
    }

    public function store(Request $request) // add to cart
    {
        $request->validate([
            'quantity'=>['required','numeric','min:1']
        ]);

        if(Auth::check()){
            Cart::create([
                'product_id'=>$request->post('product_id'),
                'client_id'=>auth()->user()->id,
                'quantity'=>$request->post('quantity')
            ]);
            session()->flash('success','Product Added To Cart Successfully');
            return redirect()->to('/product');

        }else{
            return redirect()->route('login');
        }
    }
}
