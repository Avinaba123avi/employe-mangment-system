<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\registeruser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminCrudController extends Controller
{
   public function showUsers(Request $request)
   {
      $allowedSortColumns = ['regiuser_id', 'user_type', 'first_name', 'last_name', 'email'];
      $allowedSortDirections = ['asc', 'desc'];
  
      $sortColumn = $request->get('sort', 'regiuser_id');
      if (!in_array($sortColumn, $allowedSortColumns)) {
          $sortColumn = 'regiuser_id';
      }
  
      $sortDirection = $request->get('direction', 'asc');
      if (!in_array($sortDirection, $allowedSortDirections)) {
          $sortDirection = 'asc';
      }
  
      $page = $request->input('page', 1);
      if (!is_numeric($page) || $page < 1) {
          abort(404);
      }
  
      $keyword = $request->get('search');
      $perPage = 4;
  
      $usersQuery = registeruser::query()
      ->leftJoin('usertypes', 'registerusers.usertype_id', '=', 'usertypes.usertype_id')
        ->select('registerusers.*', 'usertypes.user_type');

      if (!empty($keyword)) {
          $usersQuery->where(function ($query) use ($keyword) {
              $query->where('first_name', 'LIKE', "%$keyword%")
                    ->orWhere('last_name', 'LIKE', "%$keyword%");
          });
      }

      if ($sortColumn === 'user_type') {
         $usersQuery->orderBy('usertypes.user_type', $sortDirection);
     } else {
         $usersQuery->orderBy('registerusers.' . $sortColumn, $sortDirection);
     }

      $users = $usersQuery->paginate($perPage, ['*'], 'page', $page);
  
      if ($users->isEmpty() && $page > 1) {
         abort(404);
     }
  
      // $currentPageItems = $users->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

      // $users->setCollection($currentPageItems);
  
      return view('admincrud', ['data' => $users])->with('i', ($page - 1) * $perPage);
}

   public function singleUser($id)
   {
      if (!is_numeric($id)) {
         abort(404);
     }
 
     $user = DB::table("registerusers")->where('regiuser_id', $id)->get();

     if (!$user) {
      abort(404);
    }
 
     return view('singleuser', ['data'=> $user]);
   }
   public function deleteUser(int $id)
   {
      $user = DB::table("registerusers")->where("regiuser_id",$id)->delete();
      if($user){
         return redirect()->route('admin.crud')->with('success','The User Has Been Deleted');
      }
   }

   public function addUser(Request $request)
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

     return redirect()->route('admin.crud')->with('status','User Has Been Successfully Added.');
}

public function updateUser($regiuser_id)
{
//    if (!is_numeric($regiuser_id)) {
//       abort(404);
//   }

   $users = registeruser::find($regiuser_id);

   if($users)
   {
      return view("updateuser",compact('users'));
   }
   else{
      return redirect()->route('admin.crud')->with('error', 'User not found');
   }
  
}
public function updatePage(Request $request,int $id)
{
   $registerUser = registeruser::find($id);

   $registerUser->first_name = $request->first_name;
   $registerUser->last_name = $request->last_name;
   $registerUser->email = $request->email;
   $registerUser->usertype_id = $request->usertype_id;
   $registerUser->save();

   return redirect()->route('admin.crud')->with('status','User Has Been Updated Successfully.');


}

}
