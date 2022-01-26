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
            $isUser = User::where('social_id', $user->getId())
                            ->orWhere('email',$user->getEmail())
                            ->first();

            if($isUser!=null && ($isUser->reg_from=='google' || $isUser->reg_from=='facebook')){
                Auth::loginUsingId($isUser->id);
                return redirect()->route('/');
            }else{
                if($user==null){
                    return redirect()->route('login')->with('errorSocial','There is some problem. Please Contact To Administrator');
                }else{
                    $createUser = User::create([
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'social_id' => $user->getId(),
                        'photo'=>$user->getAvatar(),
                        'email_verified_at'=>date('Y-m-d H:i:s'),
                        'reg_from'=>$service,
                        'password'=>bcrypt('password'),
                    ]);
                    Auth::loginUsingId($createUser->id);
                    return redirect()->route('/');
                }
            }
        } catch (Exception $exception) {
           //facebook error
           if(isset($_GET['error_code'])){
            $error_code=$_GET['error_code'];
            if($error_code==200){
                return redirect()->to('login');
            }
           }
           
           if($exception->errorInfo[0]==23000){
                return redirect()->route('login')->with('errorSocial','Sorry, The Email is Already Taken');
            }else{
                dd($exception->getMessage());
            }
        }
    }
}
