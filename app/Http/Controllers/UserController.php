<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    public function userRegisation()
    {
        //$roles = roles::all(); // Get all roles
        return view('user');
    }

    public function processRegistration(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles_id' => 'required', 
        ]);
        
        $user = new users();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role_id = $request->input('roles');
        $user->save();

         return redirect()->route('user.registration')->with('success', 'User registered successfully!');
    }

    }
