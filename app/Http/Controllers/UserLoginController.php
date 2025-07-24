<?php

namespace App\Http\Controllers;

use App\Models\loginuser;
use App\Models\registeruser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Mews\Captcha\Facades\Captcha;
class UserLoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
             "captcha" => "required|captcha"
        ],[
            'captcha.captcha' => 'The entered CAPTCHA is wrong.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        $user = registeruser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $remember = $request->has('remember');
      
            Auth::login($user,$remember);

            if ($remember) {
                Cookie::queue('email', $request->email, 120); 
                Cookie::queue('password', $request->password, 120); 
            } else {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }

            switch ($user->usertype_id) {
                case 1:
                    return redirect('/admin');
                case 2:
                    return redirect('/manager');
                case 3:
                    return redirect('/employee');
                default:
                    return redirect()->back()->with('error', 'User type not recognized');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter the correct email and password');
        }


        }

        public function captchaImage()
        {
            return response()->json(['captcha' => Captcha::img()]);
        }
    
        public function refreshCaptcha()
        {
            return response()->json(['captcha' => Captcha::img()]);
        }
    
        public function logout()
        {
            Auth::logout();
            return redirect('/');
        }
    
}