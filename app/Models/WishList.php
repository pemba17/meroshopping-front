<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishList extends Model
{
    use HasFactory;
    protected $fillable=['client_id','product_id'];
    protected $table='wishlists';

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function addWishList($id){
        if(Auth::check()){
            $product=Product::findOrFail($id);
            if($product){
                WishList::updateOrCreate([
                     'product_id'=>$id,
                     'client_id'=>auth()->user()->id
                 ],[
                     'product_id'=>$id,
                     'client_id'=>auth()->user()->id 
                 ]);
                return true;
            }
        }else{
            return false;
        }
    }
}
