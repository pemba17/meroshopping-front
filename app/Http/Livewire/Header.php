<?php

namespace App\Http\Livewire;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use DB;

use Livewire\Component;

class Header extends Component
{    
    protected $listeners=['updateCart'=>'render'];
        
    public function render()
    {
        $client_id=Auth::check()?auth()->user()->id:$_COOKIE['device'];
        $cart_details=Cart::with('product')->where('client_id',$client_id)->get(); 
        $total_sum=Cart::select()
                        ->rightJoin('products','carts.product_id','products.id')
                        ->where('client_id',$client_id)
                        ->sum(DB::raw('price * quantity')); 
        return view('livewire.header',compact('cart_details','total_sum'));
    }

    public function removeCart($id){
        Cart::removeCart($id);  
    }
}
