<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact'=>['required','numeric','digits_between:7,10','unique:clients'],
            'address'=>['nullable','string','max:50']

        ]);
    }

    public function getUsers(){
        return User::all();
    }

    public function register(Request $request)
    {
        $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'contact'=>$request['contact'],
            'address'=>$request['address'],
            'reg_from'=>'meroshopping'
        ]);
        $token= $user->createToken('userapitoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        if($response){
            return [
                $message="Registered Successfully",
                $data=$response
            ];
        }else{
            return[
                $message="Error Registering",
            ];
        }

    }

    public function logout(Request $request){
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'loggedOut Successfully'], 200);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'contact' => 'required',
            'password' => 'required',
        ]);


        $fieldType = filter_var($request->contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'contact';
        if(auth()->attempt(array($fieldType => $input['contact'], 'password' => $input['password'])))
        {
            return response()->json(['message'=>'Login Successfully'],201);
        }else{
            return response()->json(['message'=>'Email-Address and Password are Wrong']);
        }
    }
}
