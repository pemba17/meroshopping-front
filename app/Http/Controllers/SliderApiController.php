<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderApiController extends Controller
{
    public function getSliders(){
        $sliders=DB::table('main_sliders')->select('link','status','position','image')->where('status',1)->orderBy('position','asc')->get();
        if($sliders){
            return response()->json(['data'=>$sliders]);
        }
        else{
            return response()->json(['error'=>'No Sliders Found']);
        }

    }
}
