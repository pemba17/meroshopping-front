<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendingSearch extends Model
{
    use HasFactory;
    protected $table='trending_search';
    protected $guarded=[];

    public static function addSearch($name){
        $check=Product::where('name','LIKE','%'.$name.'%')->get();
        if(count($check)>0){
           
            $search=TrendingSearch::where('name',trim($name))->first();
            if($search) TrendingSearch::where('name',trim($name))->update(['count'=>$search->count+1]);
            else TrendingSearch::create([
                'name'=>$name,
                'count'=>1
            ]);
        }
    }
}
