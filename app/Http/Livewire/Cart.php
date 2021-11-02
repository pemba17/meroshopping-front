<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as Carts;
use App\Models\Product;
use DB;

class Cart extends Component
{
    public $quantity=[];
    public $stock=[];

    public function mount(){
        $this->quantity=Carts::select()
        ->where('client_id',auth()->user()->id)
        ->pluck('quantity')
        ->toArray();

        $this->stock=Carts::select()
        ->rightJoin('products','carts.product_id','products.id')
        ->where('client_id',auth()->user()->id)
        ->pluck('stock')
        ->toArray();
    }

    public function render()
    {
        $details=Carts::with('product')->where('client_id',auth()->user()->id)->get(); 
        $total_sum=Carts::select()
            ->rightJoin('products','carts.product_id','products.id')
            ->where('client_id',auth()->user()->id)
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

        return redirect()->to('cart');
    }
    
}
