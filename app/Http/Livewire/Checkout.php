<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $carts,$total_sum=0,$name,$email,$contact,$address,$city,$state,$comments,$discount=0,$delivery_charge=0;

    public function updatedCity(){
        if($this->city!=""){
            if($this->city=='Kathmandu'){
                $this->delivery_charge=400;
            }else{
                $this->delivery_charge=150;
            }
        }
    }

    public function mount(Request $request){
        $this->emit('updateCart',['discount'=>500]);
        $this->carts=json_decode($request->post('cart'),true);
        $this->total_sum=$request->post('total_sum');
        $this->discount=$request->post('discount');     
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

       $info=[
           'name'=>$this->name,
           'address'=>$this->address,
           'email'=>$this->email,
           'contact'=>$this->contact,
           'address'=>$this->address,
           'city'=>$this->city,
           'state'=>$this->state,
           'comments'=>$this->comments,
           'cart'=>$this->carts,
           'amount'=>$this->total_sum,
           'discount'=>$this->discount,
           'delivery_charge'=>$this->delivery_charge

       ];
       return redirect()->to('/payment')->with('info',$info);
    }
}
