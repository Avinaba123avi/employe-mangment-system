<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NewPasswordController extends Controller
{
    public function newpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed',
            'confirm_password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $email = session('password_reset_email');

        if (!$email) {
            return redirect()->route('user.forgetpassword')->with('error', 'Invalid reset request. Please initiate password reset again.');
        }

        $password = $request->password;

        DB::table('loginusers')
            ->where('email', $email)
            ->update(['password' => Hash::make($password)]);

        session()->forget('password_reset_email');
        session()->forget('password_reset_otp');

        return redirect()->route('user.newpassword')->with('success', 'Your password has been successfully updated.');
    }
}
