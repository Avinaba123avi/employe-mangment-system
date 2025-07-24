<?php

namespace App\Http\Controllers;
use App\Models\permission;
use App\Models\usertype;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\registeruser;
use Illuminate\Support\Facades\Hash;

class AdminRolesController extends Controller
{
    public function showUserType( Request $request)
    {
      $allowedSortColumns = ['usertype_id', 'user_type'];
      $allowedSortDirections = ['asc', 'desc'];
  
      $sortColumn = $request->get('sort', 'usertype_id');
      if (!in_array($sortColumn, $allowedSortColumns)) {
          $sortColumn = 'usertype_id';
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
      $perPage = 2;
  
      $usersQuery = usertype::query();
      if (!empty($keyword)) {
          $usersQuery->where(function ($query) use ($keyword) {
              $query->where('user_type', 'LIKE', "%$keyword%");
          });
      }
      $users = $usersQuery->paginate($perPage, ['*'], 'page', $page);
  
      if ($users->isEmpty() && $page > 1) {
         abort(404);
     }
  
      $currentPageItems = $users->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

      $users->setCollection($currentPageItems);
  
      return view('adminroles', ['data' => $users])->with('i', ($page - 1) * $perPage);

    }

    public function deleteUserType(int $id)
    {
      if (!is_numeric($id)) {
         abort(404);
       }

        $user = DB::table("usertypes")->where("usertype_id",$id)->delete();
         if($user){
            return redirect()->route('admin.roles')->with('success','The Role Has Been Deleted');
         }
    }

    public function addUserType(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_type' => 'required|string|max:255',
            
         ]);
   
         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
   
        $usertype = new usertype();
        $usertype->user_type = $request->user_type;
        $usertype->save();
   
        return redirect()->route('admin.roles')->with('status','Role Has Been Successfully Added.');
    }

public function updateUserType($usertype_id)
{
   if (!is_numeric($usertype_id)) {
      abort(404);
  }

   $users = usertype::find($usertype_id);

   if($users)
   {
      return view("updateusertype",compact('users'));
   }
   else{
      return redirect()->route('admin.roles')->with('error', 'Role not found');
   }
  
}

public function updatePageType(Request $request,int $id)
{
    $usertype = usertype::find($id);

    $usertype->user_type = $request->user_type;
    $usertype->save();

   return redirect()->route('admin.roles')->with('status','Role Has Been Updated Successfully.');


}

public function addPermissionToRole($id)
{
    if (!is_numeric($id)) {
        abort(404);
    }

    $usertype = usertype::find($id);

    if (!$usertype) {
        abort(404);
    }

    $permissions = permission::get();
    return view('editrolepermissions', compact('permissions','usertype'));
}

public function givePermissionToRole(Request $request,$usertype_id)
{

    $validate = Validator::make($request->all(), [
        'permissions' => 'required|array',
        'permissions.*' => 'integer'
        
     ]);

     if ($validate->fails()) {
        return redirect()->back()->withErrors($validate)->withInput();
    }

    $usertype = usertype::findOrFail($usertype_id);
    $usertype->permissions()->sync($request->permissions);
    return redirect()->route('admin.roles')->with('success', 'Pemissions added to role successfully.');

}

}
