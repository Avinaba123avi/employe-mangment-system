<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registeruser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ManagerCrudController extends Controller
{
    public function showEmployess( Request $request)
    {
      $validSortColumns = ['regiuser_id','usertype_id', 'first_name', 'last_name', 'email'];

        $keyword = $request->get('search');
         $perPage = 3;

      $sortColumn = $request->get('sort', 'regiuser_id');
      $sortDirection = $request->get('direction', 'asc');

      if (!in_array($sortColumn, $validSortColumns)) {
         abort(404, 'Page not found');
     }

      if (!in_array($sortDirection, ['asc', 'desc'])) {
         abort(404);
     }

      $page = $request->input('page', 1);
      if (!is_numeric($page) || $page < 1) {
          abort(404);
      }

      if(!empty($keyword))
      {
         $usersQuery  = registeruser::where('first_name','LIKE',"%$keyword%")
                                 ->orWhere('last_name','LIKE',"%$keyword%")
                                 ->where('usertype_id', 3)
                                 ->orderBy($sortColumn, $sortDirection)
                                 ->paginate($perPage);
      }
      else
      {
         $usersQuery = registeruser::where('usertype_id', 3);
      }

      $user = $usersQuery->paginate($perPage, ['*'], 'page', $page);

      $currentPageUsers = collect($user->items());
      if ($sortDirection === 'asc') {
          $currentPageUsers = $currentPageUsers->sortBy($sortColumn);
      } else {
          $currentPageUsers = $currentPageUsers->sortByDesc($sortColumn);
      }

      $user->setCollection($currentPageUsers->values());

      if ($user->isEmpty() && !empty($keyword)) {
         abort(404);
     }

     return view('managercrud',[
      'data' => $user,
      'i' => ($request->input('page', 1) - 1) * $perPage,
      ]);
   }

    public function singleEmployee($id)
   {
      if (!is_numeric($id)) {
         abort(404);
     }
    $user = DB::table("registerusers")->where('regiuser_id',$id)->get();
    return view('singleemployee', ['data'=> $user]);
   }
//    public function deleteUser(int $id)
//    {
//       $user = DB::table("registerusers")->where("regiuser_id",$id)->delete();
//       if($user){
//          return redirect()->route('admin.crud')->with('success','The User Has Been Deleted');
//       }
//    }

public function addEmployees(Request $request)
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

     $registerUser = new registeruser();
     $registerUser->first_name = $request->first_name;
     $registerUser->last_name = $request->last_name;
     $registerUser->email = $request->email;
     $registerUser->usertype_id = $request->usertype_id;
     $registerUser->password = Hash::make($request->password);
     $registerUser->save();

     return redirect()->route('manager.crud')->with('status','User Has Been Successfully Added.');
}

public function updateEmployee($regiuser_id)
{
   if (!is_numeric($regiuser_id)) {
      abort(404);
  }
   $users = registeruser::find($regiuser_id);

   if($users)
   {
      return view("updateemployee",compact('users'));
   }
   else{
      return redirect()->route('manager.crud')->with('error', 'User not found');
   }
  
}

public function updateEmpPage(Request $request,int $id)
{
   $registerUser = registeruser::find($id);

   $registerUser->first_name = $request->first_name;
   $registerUser->last_name = $request->last_name;
   $registerUser->email = $request->email;
   $registerUser->usertype_id = $request->usertype_id;
   $registerUser->save();

   return redirect()->route('manager.crud')->with('status','User Has Been Updated Successfully.');

}

public function deleteEmployee(int $id)
   {
      $user = DB::table("registerusers")->where("regiuser_id",$id)->delete();
      if($user){
         return redirect()->route('manager.crud')->with('success','The User Has Been Deleted');
      }
   }

}
