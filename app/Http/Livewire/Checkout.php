<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Checkout as Checkouts;

class Checkout extends Component
{
    public $carts,$total_sum=0,$name,$email,$contact,$address,$city,$state,$comments,$cart_id=[];

    public function mount(Request $request){
        $this->carts=json_decode($request->post('cart'),true);
        $this->total_sum=$request->post('total_sum');
    
        $user=User::find(auth()->user()->id);
        $this->name=$user->name;
        $this->email=$user->email;
        $this->contact=$user->contact;
        $this->address=$user->address;
    }
    public function render()
    {
        $this->cart_id=array_column($this->carts, 'id');
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

       Checkouts::create([
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

       return redirect()->to('/payment');
    }
}
