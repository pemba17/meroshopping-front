<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProductQuestion extends Model
{
    use HasFactory;
    protected $table='product_questions';
    protected $guarded=[];

    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }
}
