<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Mail;


class ResetCodeController extends Controller
{
    public function resetcode(Request $request)
    {
        $email = Session::get('password_reset_email');
        $storedOtp = Session::get('password_reset_otp');

        if (!$email || !$storedOtp) {
            return redirect()->route('user.forgetpassword')->with('error', 'Invalid reset request. Please initiate password reset again.');
        }

        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
            $enteredOtp = $request->otp;
            if ($storedOtp !== (int)$enteredOtp)
             {
                return redirect()->back()->withErrors(['otp' => 'Invalid One-Time Password (OTP)']);
             }
             else{
                return redirect('/newpassword');
             }
        
    }
}
