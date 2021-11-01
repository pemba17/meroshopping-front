<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $details=\App\Models\Cart::where('client_id',auth()->user()->id)
                                    ->get();
        return view('livewire.cart',compact('details'));
    }

    public function removeCart($id){
        \App\Models\Cart::destroy($id);
        session()->flash('success','Product Removed Successfully');
    }
}
