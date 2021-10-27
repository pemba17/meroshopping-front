<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {
        try {
            $user = Socialite::driver($service)->stateless()->user();  
            $isUser = User::where('social_id', $user->getId())->first();
            if($isUser){
                Auth::loginUsingId($isUser->id);
                return redirect()->route('home');
            }else{
                if($user==null){
                    return redirect()->route('login')->with('errorSocial','There is some problem. Please Contact To Administrator');
                }else{
                    $createUser = User::create([
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'social_id' => $user->getId(),
                        'photo'=>$user->getAvatar(),
                        'password' => Hash::make('admin@123'),
                        'email_verified_at'=>date('Y-m-d H:i:s')
                    ]);
                    Auth::loginUsingId($createUser->id);
                    return redirect()->route('home');
                }
            }
        } catch (Exception $exception) {
           if($exception->errorInfo[0]==23000){
                return redirect()->route('login')->with('errorSocial','Sorry, The Email is Already Taken');
            }else{
                dd($exception->getMessage());
            } 
        }
    }
}
