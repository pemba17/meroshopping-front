<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class WishList extends Model
{
    use HasFactory;
    protected $fillable=['client_id','product_id'];
    protected $table='wishlists';

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
