<?php

namespace App\Http\Controllers;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\registeruser;
class EmployeeTaskController extends Controller
{
    public function showEmpTask(Request $request)
    {
        $validSortColumns = ['task_id','first_name','title', 'description', 'status','start_date','submit_date'];
        $validUserSortColumns = ['first_name'];

        $keyword = $request->get('search');
        $perPage = 3;

      $sortColumn = $request->get('sort', 'task_id');
      $sortDirection = $request->get('direction', 'asc');

      if (!in_array($sortColumn, array_merge($validSortColumns, $validUserSortColumns))) {
        abort(404);
    }

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            abort(404);
        }

      $page = $request->input('page', 1);
      if (!is_numeric($page) || $page < 1) {
          abort(404);
      }

      $tasksQuery = task::where('regiuser_id', Auth::user()->regiuser_id);

      if (!empty($keyword)) {
        $tasksQuery->where('title', 'LIKE', "%$keyword%");
    }

    $tasksQuery->orderBy($sortColumn, $sortDirection);
    $tasks = $tasksQuery->paginate($perPage);


      return view('employeetaskaction', compact('tasks'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }    

    public function updateTaskStatus($task_id)
    {
       if (!is_numeric($task_id)) {
          abort(404);
      }
       $tasks= task::find($task_id);
       $employees = registeruser::where("usertype_id","3")->get();

       if($tasks && $employees)
       {
          return view("updateemptaskstatus",compact('tasks','employees'));
       }
       else{
          return redirect()->route('emptasks.show')->with('error', 'User not found');
       }
   
    }
    public function updateTaskPageStatus(Request $request,int $id)
    {
       $tasks = task::find($id);

       $tasks->status = $request->status;
       $tasks->save();

       return redirect()->route('emptasks.show')->with('status','Task Status Has Been Updated Successfully.');

    }
        
}
