<?php

namespace App\Http\Livewire;

use App\Models\WishList as WishLists;
use App\Models\Cart;
use Livewire\Component;

class Wishlist extends Component
{
    public function render()
    {
        $wishlist=WishLists::with('product')->where('client_id',auth()->user()->id)
                            ->get();
        return view('livewire.wishlist',compact('wishlist'));
    }

    public function removeWishList($id){
        WishLists::destroy($id);
    }

    public function addWishList($product_id){
        $cart=Cart::where('client_id',auth()->user()->id)
                    ->where('product_id',$product_id)
                    ->first();
        
        if($cart){
            $cart->update([
                'quantity'=>$cart->quantity+1
            ]);
        }else{
            Cart::create([
                'client_id'=>auth()->user()->id,
                'quantity'=>1,
                'product_id'=>$product_id
            ]);
        }      
        session()->flash('success',"Product Added To Cart Successfully");
        $this->emit('updateCart');
    }
}
