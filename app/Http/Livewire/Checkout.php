<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Cookie;
use DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryArea;
use App\Models\DeliveryCity;
use App\Models\DeliveryRegion;
use App\Models\ShippingTime;
use App\Models\ColorProduct;
use App\Models\SizeProduct;

class Checkout extends Component
{
    public $carts,$total_sum=0,$name,$email,$contact,$address,$city,$state,$comments,$discount=0,$delivery_charge=0,$quantity=[],$client_id,$coupon,$shipping_time,$city_area;
    public $showCity=false,$showArea=false;
    public $couponPercent=0;
    public $all_status=false,$in_status=false;
    public $shipping_details;

    public function updatedState(){
        $this->city="";
        $this->city_area="";
        if($this->state!=null || $this->state!=""){
            $this->showCity=true;
        }else{
            $this->showCity=false;
            $this->showArea=false;
        }
    }
    public function updatedCity(){
        $this->city_area="";
        if($this->city!=null || $this->city!=""){
            $this->showArea=true;
            $city=DeliveryCity::where('id',$this->city)->first();
            if($city->inside_valley==1 && $this->in_status==true) $this->delivery_charge=0;
            elseif($this->all_status==true) $this->delivery_charge=0;
            else $this->delivery_charge=DeliveryCity::where('id',$this->city)->pluck('delivery_price')->first();
        }else{
            $this->showArea=false;
        }
    }

    public function mount(Request $request){
        $this->client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $carts=Cart::with('product')->where('client_id',$this->client_id)->get()->toArray();
        if(count($carts)<1) return redirect()->to('/cart');
        $this->carts=json_decode(json_encode($carts),true);
        // to check if product is all free or inside free
        $products=array_column($this->carts,'product');
        $all_free=array_column($products,'all_free');
        $in_free=array_column($products,'in_free');
        if(!in_array(0,$all_free)) $this->all_status=true;
        if(!in_array(0,$in_free)) $this->in_status=true;
        // end
        $this->quantity=array_column($this->carts,'quantity');
        // foreach($products as $key=>$row){
        //     if($this->quantity[$key]>$row['stock']) return redirect()->to('cart')->with('success','The product '.($key+1).' quantity must not be greater than '.$row['stock']);
        // }
        $this->discount=$request->post('discount');
        $this->couponPercent=$request->post('couponPercent');
        if(Auth::check()){
            $user=User::find(auth()->user()->id);
            $this->name=$user->name;
            $this->email=$user->email;
            $this->contact=$user->contact;
            $this->address=$user->address;
        }

        $this->shipping_details=ShippingTime::where('status',1)->get();
    }
    public function render()
    {
        $carts=Cart::with('product')->where('client_id',$this->client_id)->get()->toArray();
        $regions=DeliveryRegion::orderBy('region_name','asc')->get();
        $cities=DeliveryCity::select()
                            ->orderBy('city_name','asc')
                            ->when($this->state,function($q,$state){
                                $q->where('region_id',$state);
                            })
                            ->where('show_in_front',1)
                            ->get();

        $areas=DeliveryArea::select()
                            ->orderBy('area_name','asc')
                            ->when($this->city,function($q,$city){
                                $q->where('city_id',$city);
                            })->get();

        $this->carts=json_decode(json_encode($carts),true);
        $this->total_sum=Cart::select()
                        ->rightJoin('products','carts.product_id','products.id')
                        ->where('client_id',$this->client_id)
                        ->sum(DB::raw('price * quantity'));

        if($this->couponPercent>0) $this->discount=round(($this->couponPercent/100)*$this->total_sum);

        return view('livewire.checkout',compact('regions','cities','areas'));
    }

    public function save(){
       $this->validate([
           'name'=>['required','string','max:50'],
           'email'=>['required','email','max:255'],
           'contact'=>['required','numeric','digits_between:7,10'],
           'address'=>['nullable','string','max:100'],
           'state'=>['required'],
           'city'=>($this->state!=null || $this->state!="")?['required']:[],
           'city_area'=>($this->city!=null || $this->city!="")?['nullable']:[],
           'shipping_time'=>['required']
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
           'total_amount'=>$this->total_sum-$this->discount+$this->delivery_charge,
           'area'=>$this->city_area,
           'shipping_time'=>$this->shipping_time
       ];

       $info=json_encode($info);
       return redirect()->to('/payment')->with('info',$info);
    }

    public function updateCart($id,$key,$product_id,$color=null,$size=null){
        if($product_id){
            if($color && $size==null)
                $stock=ColorProduct::where('product_id',$product_id)->where('color_id',$color)->pluck('stock')->first();
            elseif($size && $color==null)
                $stock=SizeProduct::where('product_id',$product_id)->where('size_id',$size)->pluck('stock')->first();
            else
                $stock=Product::where('id',$product_id)->pluck('stock')->first();
        }
        $this->validate([
            'quantity.'.$key=>['required','numeric','min:1','max:'.$stock]
        ]);
        $carts=Cart::updateCart($id,$this->quantity[$key]);
        $this->emit('updateCart');
    }

    public function removeCart($id){
        Cart::removeCart($id);
        $carts=Cart::where('client_id',$this->client_id)->get();
        $this->emit('updateCart');
        if(count($carts)<1) return redirect()->to('/cart');
    }

    public function applyCoupon(){
        $this->validate(['coupon'=>['required']]);
        $coupon=Coupon::applyCoupon($this->coupon);
        if($coupon==null) session()->flash('couponError','Coupon is invalid');
        else if($coupon && $coupon->exp_date<date('Y-m-d')) session()->flash('couponError','The apply coupon has been expired');
        else if($coupon && $coupon->status==0) session()->flash('couponError','The coupon is inactive currently');
        else if($coupon && $coupon->status==1 && $coupon->exp_date>=date('Y-m-d')) {$this->discount=round(($coupon->discount/100)*$this->total_sum); $this->couponPercent=$coupon->discount;}
        else $this->couponPercent=0;
        $this->coupon='';
    }

}
