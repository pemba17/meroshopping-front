<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductTag;

class Tag extends Model
{
    use HasFactory;

    public function productTag(){
        return $this->hasMany(ProductTag::class,'tagId');
    }
}
