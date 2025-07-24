<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class ForgotPasswordController extends Controller
{
    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        {
            $email = $request->email;
            $fpass = DB::table('loginusers')->where('email',$email)->first();

            if ($fpass) 
            {
                $otp = mt_rand(100000, 999999);

                Session::put('password_reset_otp', $otp);
                Session::put('password_reset_email',$email);

                $this->sendOTPByEmail($email, $otp);    

                return redirect('/resetcode')->with('success','A password reset code has been sent to your email address.');
            }
            else
            {
                return redirect()->back()->with('error','Please enter the valid Email Address');
            }
        }
    }

    private function sendOTPByEmail($email, $otp)
    {
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($email) {
            $message->to($email)->subject('Password Reset OTP');
        });
    }
}