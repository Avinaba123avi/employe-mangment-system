<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class myusercontroller extends Controller
{
   public function myuser()
   {
    //$user = DB::table("users")->select('name')->distinct()->get();
    //$user = DB::table("users")->pluck('name');
    //$user = DB::table("users")->whereIn('role_id',[1,3])->get();
    //$user = DB::table("users")->whereDay("created_at",'10')->get();
    //$user = DB::table("users")->orderBy('name','desc')->get();
    //$user = DB::table("users")->limit(3)->offset(2)->get();
   //$user = DB::table("users")->orderBy('name')->simplePaginate(5);
      $user = DB::table("registerusers")->paginate(4);
    //dd($user);
    return view('alluser', ['data'=> $user]);
    //return $user;
   }

   public function mysingleuser(int $id)
   {
    $user = DB::table("registerusers")->where('id',$id)->get();
    return view('singleuser', ['data'=> $user]);
   }

   public function adduser(Request $request)
   {
      $user = DB::table('registerusers')->insert([
         ['name'=> $request->name,
         'email'=> $request->email,
         'role_id' => $request->roles,
         'password' => $request->password,
      ]
      ]);
      //return $user;

      if($user){
         //echo "<h1>Data Successfully Added.</h1>";
         return redirect()->route('home');
      }
      else
      {
         echo "<h1>Data is not Added</h1>";
      }
}

public function updateuser(string $id)
{

   $user = DB::table("users")->where("id",$id)->get();
   //$user = DB::table("users")->find($id);
   return view("updateuser", ["data"=> $user]);
   
}

public function deleteuser(string $id)
{
   $user = DB::table("users")->where("id",$id)->delete();
   if($user){
      return redirect();
   }
}

public function updatePage(string $id)
{
   $user = DB::table('users')->where('id',4)->update(['name' => 'Ram Rahim']);
   if($user){
         echo "<h1>Data Successfully Updated.</h1>";
      }
      else
      {
         echo "<h1>Data is not Updated</h1>";
      }
}
}
