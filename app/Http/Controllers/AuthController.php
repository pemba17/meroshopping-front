<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
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
        if($token){
            return response()->json(['message'=>'Registered Successfully','token'=>$token]);
        }else{
            return response()->json(['message'=>'Error Registering']);
        }

    }

    public function logout(Request $request)
    {
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
        $user=User::where('contact',$input['contact'])->first();

        $fieldType = filter_var($request->contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'contact';

        if(auth()->attempt(array($fieldType => $input['contact'], 'password' => $input['password'])))
        {
            $token= $user->createToken('userapitoken')->plainTextToken;
            return response()->json(['message'=>'Login Successfully','token'=>$token],201);
        }else{
            return response()->json(['message'=>'Email-Address and Password are Wrong']);
        }
    }

    public function forgotPassword(Request $request)
    {
        $credentials=request()->validate(['email'=>'required|email']);
        Password::sendResetLink($credentials);
        return response()->json(["message"=>'Your Request has been sent.Please Check Your Email.']);
    }
    public function resetPassword(Request $request)
    {
        $credentials=request()->validate([
            'email'=>'required|email',
            'token'=>'required|token',
            'password'=>'required|string|confirmed',
        ]);
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["message" => "Invalid token provided"], 400);
        }
        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}
