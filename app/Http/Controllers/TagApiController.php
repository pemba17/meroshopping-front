<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagApiController extends Controller
{
    public function getTags(){
        $tags = Tag::select('id','name','urlname','image')->orderBy('position','asc')->get();
        if($tags){
            return response()->json(['data'=>$tags]);
        }
        else{
            return response()->json(['error'=>'No Tags Found']);
        }
    }
}
