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

    public function addCart($product_id){
        $output=Cart::addCart($product_id,1);
        if($output) session()->flash('success',"Product Added To Cart Successfully");
        $this->emit('updateCart');
    }
}
