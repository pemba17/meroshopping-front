<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

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
}
