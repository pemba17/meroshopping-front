<?php

namespace App\Http\Livewire;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;
use Cookie;
use App\Models\WishList;

class Header extends Component
{    
    protected $listeners=['updateCart'=>'render'];
    public function render()
    {
        $client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $cart_details=Cart::with('product')->where('client_id',$client_id)->get(); 
        $total_sum=Cart::select()
                        ->rightJoin('products','carts.product_id','products.id')
                        ->where('client_id',$client_id)
                        ->sum(DB::raw('price * quantity')); 

        $categories=Category::whereNull('parentId')->get();
        $tags=Tag::where('status',1)->orderBy('position','asc')->get();

        $wishlists_count=WishList::where('client_id',$client_id)->count();

        $notices=DB::table('notices')->where('status',1)->get();

        return view('livewire.header',compact('cart_details','total_sum','categories','tags','wishlists_count','notices'));
    }

    public function removeCart($id){
        Cart::removeCart($id);
        return redirect()->to('cart');
    }
}
