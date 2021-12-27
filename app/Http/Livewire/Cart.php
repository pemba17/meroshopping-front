<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as Carts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;
use Cookie;
use App\Models\Coupon;
use App\Models\SizeProduct;
use App\Models\ColorProduct;

class Cart extends Component
{
    public $quantity=[];
    public $stock=[];
    public $client_id;

    public $coupon;
    public $discount=0;
    public $total_sum=0;
    public $couponPercent=0;

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
        $this->total_sum=Carts::select()
            ->rightJoin('products','carts.product_id','products.id')
            ->where('client_id',$this->client_id)
            ->sum(DB::raw('price * quantity'));

        if($this->couponPercent>0) $this->discount=round(($this->couponPercent/100)*$this->total_sum);

        return view('livewire.cart',compact('details'));
    }

    public function removeCart($id){
        Carts::removeCart($id);
        session()->flash('success','Product Removed Successfully');
        $this->emit('updateCart');
    }

    public function updateCart($id,$key,$color=null,$size=null){
        $cart=Carts::find($id);
        if($cart->product_id){
            if($color && $size==null)
                $this->stock[$key]=ColorProduct::where('product_id',$cart->product_id)->where('color_id',$color)->pluck('stock')->first();
            elseif($size && $color==null)
                $this->stock[$key]=SizeProduct::where('product_id',$cart->product_id)->where('size_id',$size)->pluck('stock')->first();
        }
        $this->validate([
            'quantity.'.$key=>['required','numeric','min:1','max:'.$this->stock[$key]]
        ]);
        Carts::updateCart($id,$this->quantity[$key]);
        $this->emit('updateCart');
    }

    public function increment($key){
        $this->quantity[$key]++;
    }

    public function decrement($key){
        $this->quantity[$key]--;
    }

    public function applyCoupon(){
        $this->validate([ 'coupon'=>'required']);
        $coupon=Coupon::applyCoupon($this->coupon);
        if($coupon==null) session()->flash('couponError','Coupon is invalid');
        else if($coupon && $coupon->exp_date<date('Y-m-d')) session()->flash('couponError','The apply coupon has been expired');
        else if($coupon && $coupon->status==0) session()->flash('couponError','The coupon is inactive currently');
        else if($coupon && $coupon->status==1 && $coupon->exp_date>=date('Y-m-d')) {$this->discount=round(($coupon->discount/100)*$this->total_sum); $this->couponPercent=$coupon->discount;}
        else $this->couponPercent=0;
        $this->coupon='';
    }
}
