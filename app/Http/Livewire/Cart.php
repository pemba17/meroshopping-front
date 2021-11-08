<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as Carts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;
use Cookie;

class Cart extends Component
{
    public $quantity=[];
    public $stock=[];
    public $client_id;

    public $coupon;
    public $discount=0;

    public function mount(){    
        $this->client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $this->quantity=Carts::select()
        ->where('client_id',$this->client_id)
        ->pluck('quantity')
        ->toArray();

        $this->stock=Carts::select()
        ->rightJoin('products','carts.product_id','products.id')
        ->where('client_id',$this->client_id)
        ->pluck('stock')
        ->toArray();
    }

    public function render()
    {
        $details=Carts::with('product')->where('client_id',$this->client_id)->get(); 
        $total_sum=Carts::select()
            ->rightJoin('products','carts.product_id','products.id')
            ->where('client_id',$this->client_id)
            ->sum(DB::raw('price * quantity'));
            
        return view('livewire.cart',compact('details','total_sum'));
    }

    public function removeCart($id){
        Carts::destroy($id);
        session()->flash('success','Product Removed Successfully');
    }

    public function updateCart($id,$key){          
        $this->validate([
            'quantity.*'=>['required','numeric','min:1','max:'.$this->stock[$key]]
        ]);

        $detail=Carts::find($id);

        $detail->update([
            'quantity'=>$this->quantity[$key]
        ]);

        $this->emit('updateCart');
    }

    public function increment($key){
        $this->quantity[$key]++;
    }

    public function decrement($key){
        $this->quantity[$key]--;
    }

    public function applyCoupon(){
       $this->discount=200;
       $this->emit('updateCart',['discount'=>$this->discount]);
    }    
}
