<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileApiController extends Controller
{

    public function getProfile(Request $request)
    {
        $user=User::find(auth()->user()->id);
        if($user){
            return response()->json(['data'=>$user]);
        }else{
            return response()->json(['error'=>'Profile Not Found']);
        }
    }

    // edit profile
    public function editProfile(Request $request)
    {
        $user=User::find(auth()->user()->id);
        return response()->json(['data'=>$user]);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:100'],
            'address'=>['nullable','string','max:50'],
            'contact'=>['required','numeric','digits:10',Rule::unique('clients')->ignore($request->user_id)],
            'photo'=>['nullable','image'],
            'phone'=>['nullable','numeric','digits:7',Rule::unique('clients')->ignore($request->user_id)],
            'dob'=>['nullable','date'],
            'gender'=>['nullable','string','max:20'],
            'country'=>['nullable','string','max:50'],
            'state'=>['nullable','string','max:50'],
            'city'=>['nullable','string','max:50'],
            'zip_code'=>['nullable','numeric','digits_between:1,10']
        ]);
        if($request->photo==null){
            $filepath=auth()->user()->photo;
        }else{
            $filename=$request->photo->store('/','user_image');
            $filepath=Storage::disk('user_image')->url($filename);
        }
        User::where('id',$request->user_id)
              ->update([
                'name'=>$request->name,
                'address'=>$request->address,
                'contact'=>$request->contact,
                'photo'=>$filepath,
                'phone'=>$request->phone,
                'dob'=>$request->dob,
                'gender'=>$request->gender,
                'country'=>$request->country,
                'state'=>$request->state,
                'city'=>$request->city,
                'zip_code'=>($request->zip_code==null || $request->zip_code=="")?null:$request->zip_code
        ]);
    }
}
