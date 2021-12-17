<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsApiController extends Controller
{
    public function getBrands(){
        $brands = Brand::select('id','name','urlname','logo','front')->get();
        if($brands){
            return response()->json(['data'=>$brands]);
        }
        else{
            return response()->json(['error'=>'No Brands Found']);
        }
    }
}
