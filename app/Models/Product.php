<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Retailer;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function retailer(){
        return $this->belongsTo(Retailer::class,'retailerId');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brandId');
    }
}
