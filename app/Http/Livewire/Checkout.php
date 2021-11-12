<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Cookie;
use App\Models\Product;
use DB;
use App\Models\Coupon;

class Checkout extends Component
{
    public $carts,$total_sum=0,$name,$email,$contact,$address,$city,$state,$comments,$discount=0,$delivery_charge=0,$quantity=[],$client_id,$coupon;
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
        $this->client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $carts=Cart::with('product')->where('client_id',$this->client_id)->get()->toArray();
        $this->carts=json_decode(json_encode($carts),true);
        $this->quantity=array_column($this->carts,'quantity');
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
        $carts=Cart::with('product')->where('client_id',$this->client_id)->get()->toArray();
        $this->carts=json_decode(json_encode($carts),true);
        $this->total_sum=Cart::select()
                        ->rightJoin('products','carts.product_id','products.id')
                        ->where('client_id',$this->client_id)
                        ->sum(DB::raw('price * quantity')); 
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
           'delivery_charge'=>$this->delivery_charge,
           'total_amount'=>$this->total_sum-$this->discount-$this->delivery_charge
       ];

       $info=json_encode($info);
       return redirect()->to('/payment')->with('info',$info);
    }

    public function updateCart($id,$key,$product_id){
        $stock=Product::where('id',$product_id)->pluck('stock')->first();
        $this->validate([
            'quantity.'.$key=>['required','numeric','min:1','max:'.$stock]
        ]);
        $carts=Cart::updateCart($id,$this->quantity[$key]);
        $this->emit('updateCart');
    }

    public function removeCart($id){
        Cart::removeCart($id);
        $this->emit('updateCart');
    }

    public function applyCoupon(){
        $this->validate(['coupon'=>['required']]);
        $coupon=Coupon::applyCoupon($this->coupon);
        if($coupon==null) session()->flash('couponError','Coupon is invalid');
        if($coupon && $coupon->exp_date<date('Y-m-d')) session()->flash('couponError','The apply coupon has been expired');
        if($coupon && $coupon->status==0) session()->flash('couponError','The coupon is inactive currently');
        if($coupon && $coupon->status==1 && $coupon->exp_date>=date('Y-m-d')) $this->discount=round(($coupon->discount/100)*$this->total_sum);
        $this->coupon=''; 
    }

}
