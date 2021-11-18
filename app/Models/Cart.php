<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Cookie;

class Cart extends Model
{
    protected $fillable=['product_id','client_id','quantity','guest_id'];
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function updateCart($id,$data){
        $cart=Cart::find($id);
        $cart->update([
            'quantity'=>$data
        ]);
        return $cart;
    }

    public static function removeCart($id){
        Cart::destroy($id);
    }

    public static function addCart($product_id,$quantity){
        $client_id=Auth::check()?auth()->user()->id:Cookie::get('device');
        $data=Cart::where('product_id',$product_id)
                ->where('client_id',$client_id)
                ->first();
        if($data){
            $output=$data->update([
                'quantity'=>$data->quantity+$quantity
            ]);
        }else{
            $output=Cart::create([
                'product_id'=>$product_id,
                'client_id'=>$client_id,
                'quantity'=>$quantity
            ]);
        }
        return $output;
    }
}
