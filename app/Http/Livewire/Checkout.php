<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Checkout as Checkouts;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $carts,$total_sum=0,$name,$email,$contact,$address,$city,$state,$comments,$cart_id=[],$product_id;

    public function mount(Request $request){
        $this->carts=json_decode($request->post('cart'),true);
        $this->total_sum=$request->post('total_sum');
        
        if(Auth::check()){
            $user=User::find(auth()->user()->id);
            $this->name=$user->name;
            $this->email=$user->email;
            $this->contact=$user->contact;
            $this->address=$user->address;
        }
    }
    public function render()
    {
        $this->cart_id=array_column($this->carts, 'id');
        $this->product_id=array_column($this->carts,'product_id');
        return view('livewire.checkout');
    }

    public function save(){
       $this->validate([
           'name'=>['required','string','max:50'],
           'email'=>['required','email','max:255'],
           'contact'=>['required','numeric','digits_between:7,10'],
           'address'=>['required','string','max:100'],
           'city'=>['required','string','max:50'],
           'state'=>['required','string','max:50']
       ]);

       $checkout=Checkouts::create([
           'name'=>$this->name,
           'address'=>$this->address,
           'email'=>$this->email,
           'contact'=>$this->contact,
           'address'=>$this->address,
           'city'=>$this->city,
           'state'=>$this->state,
           'comments'=>$this->comments,
           'cart_id'=>implode(',',$this->cart_id)
       ]);

       $info=[
           'checkout_id'=>$checkout->id,
           'amount'=>$this->total_sum,
           'cart_id'=>$checkout->cart_id,
           'product_id'=>implode(',',$this->product_id),
           'quantity'=>implode(',',array_column($this->carts,'quantity'))
       ];

       return redirect()->to('/payment')->with('info',$info);
    }
}
