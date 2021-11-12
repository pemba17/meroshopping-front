<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getSubCategory($id){
        $category= Category::where('parentId',$id)->get();
        return $category;
    }
}