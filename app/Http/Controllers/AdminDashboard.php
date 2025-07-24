<?php

namespace App\Http\Controllers;

use App\Models\registeruser;
use App\Models\salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Controller
{
    public function myuser()
   {
      //$user = DB::table("registerusers")->paginate(4);
      $admins = registeruser::where("usertype_id","1")->count();
      $managers = registeruser::where("usertype_id","2")->count();
      $employees = registeruser::where("usertype_id","3")->count();
      $totalusers = registeruser::count();
      $salaries = salary::sum('amount');

      $emp = DB::table('registerusers')
      ->join('salaries', 'registerusers.regiuser_id', '=', 'salaries.regiuser_id')
      ->select('registerusers.first_name', 'salaries.amount')
      ->get();

      $employeeNames = $emp->pluck('first_name');
      $employeeSalaries = $emp->pluck('amount');
     return view('alluser', compact('admins','managers','employees','totalusers','salaries','employeeNames','employeeSalaries'));
   }

//    public function mysingleuser(int $id)
//    {
//     $user = DB::table("registerusers")->where('id',$id)->get();
//     return view('singleuser', ['data'=> $user]);
//    }

//    public function adduser(Request $request)
//    {
//       $user = DB::table('registerusers')->insert([
//          ['name'=> $request->name,
//          'email'=> $request->email,
//          'role_id' => $request->roles,
//          'password' => $request->password,
//       ]
//       ]);
//       //return $user;

//       if($user){
//          //echo "<h1>Data Successfully Added.</h1>";
//          return redirect()->route('home');
//       }
//       else
//       {
//          echo "<h1>Data is not Added</h1>";
//       }
// }

// // public function updateuser()
// // {

// //    $user = DB::table("registerusers")->where("id")->get();
// //    //$user = DB::table("users")->find($id);
// //    return view("updateuser", ["data"=> $user]);
   
// // }

// public function deleteuser(int $id)
// {
//    $user = DB::table("registerusers")->where("id",$id)->delete();
//    if($user){
//       return redirect('/admin');
//    }
// }

// public function updatePage(string $id)
// {
//    $user = DB::table('users')->where('id',4)->update(['name' => 'Ram Rahim']);
//    if($user){
//          echo "<h1>Data Successfully Updated.</h1>";
//       }
//       else
//       {
//          echo "<h1>Data is not Updated</h1>";
//       }
// }
}
