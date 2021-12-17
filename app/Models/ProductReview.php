<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProductReview extends Model
{
    use HasFactory;
    protected $table='product_reviews';
    protected $guarded=[];

    public function client(){
        return $this->belongsTo(User::class,'user_id');
    }
}

