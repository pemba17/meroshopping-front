<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public static function applyCoupon($code){
        $coupon=Coupon::where('coupon_code',$code)
                        ->first();
        return $coupon;                
    }
}
