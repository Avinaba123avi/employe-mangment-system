<?php

namespace App\Http\Controllers;

use App\Models\loginuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\registeruser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class RegisterUserController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:registerusers,email',
            'usertype_id' => 'required|integer',
            'password'=> 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            
         ],['password.confirmed' => 'The password confirmation does not match.']);

         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        try 
        {
            DB::beginTransaction();

            $registerUser = new registeruser();
            $registerUser->first_name = $request->first_name;
            $registerUser->last_name = $request->last_name;
            $registerUser->email = $request->email;
            $registerUser->usertype_id = $request->usertype_id;
            $registerUser->password = Hash::make($request->password);
            $registerUser->save();

            $loginUser = new loginuser( );
            $loginUser->regiuser_id = $registerUser->regiuser_id;
            $loginUser->email = $request->email;
            $loginUser->password = Hash::make($request->password);
            $loginUser->save();
            
            DB::commit();

         return redirect('/');
        } 
        catch (\Throwable $th)
        {
            DB::rollBack();
            throw $th;
        }


    }
}
