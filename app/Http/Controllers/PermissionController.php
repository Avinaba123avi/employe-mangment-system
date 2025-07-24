<?php

namespace App\Http\Controllers;
use App\Models\permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function showPermission()
    {
        return view('addpermissions');
    }

    public function addPermissions(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'permission_type' => 'required|string|max:255|unique:permissions',
            
         ]);
   
         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $existingPermission = Permission::where('permission_type', $request->permission_type)->first();
    if ($existingPermission) {
        return redirect()->back()->withErrors(['permission_type' => 'Permission type already exists.'])->withInput();
    }
   
        $permission = new permission() ;
        $permission->permission_type = $request->permission_type;
        $permission->save();
   
        return redirect()->route('showall.permission')->with('status','Permission Has Been Successfully Added.');
    }

    public function showAllPermissions(Request $request)
    {

        $allowedSortColumns = ['permission_id', 'permission_type'];
        $allowedSortDirections = ['asc', 'desc'];
  
      $sortColumn = $request->get('sort', 'permission_id');
      if (!in_array($sortColumn, $allowedSortColumns)) {
          $sortColumn = 'permission_id';
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
  
      $usersQuery = permission::query();
      if (!empty($keyword)) {
          $usersQuery->where(function ($query) use ($keyword) {
              $query->where('permission_type', 'LIKE', "%$keyword%");
          });
      }
      $permissions = $usersQuery->paginate($perPage, ['*'], 'page', $page);
  
      if ($permissions->isEmpty() && $page > 1) {
         abort(404);
     }
  
      $currentPageItems = $permissions->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

      $permissions->setCollection($currentPageItems);
  
      return view('showallpermission', compact('permissions'))->with('i', ($page - 1) * $perPage);

    }

    public function deletePermissions($permission_id)
    {

        $permission = permission::find($permission_id);

        if ($permission) {
            $permission->delete();
            return redirect()->route('showall.permission')->with('success', 'The Permission Has Been Deleted Successfully');
        } else {
            return redirect()->route('showall.permission')->with('error', 'Permission not found');
        }

    }

    public function updatePermission($permission_id)
    {
       if (!is_numeric($permission_id)) {
          abort(404);
      }

      $permissions = permission::find($permission_id);

       if($permissions)
       {
          return view('updatepermission',compact('permissions'));
       }
       else{
          return redirect()->route('admin.roles')->with('error', 'User not found');
       }
   
    }

    public function updatePagePermission(Request $request,int $id)
    {
        $permissions = permission::find($id);

        $permissions->permission_type = $request->permission_type;
        $permissions->save();

       return redirect()->route('showall.permission')->with('status','Permission Has Been Updated Successfully.');


    }
}
