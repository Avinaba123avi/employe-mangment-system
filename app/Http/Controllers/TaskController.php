<?php

namespace App\Http\Controllers;
use App\Models\registeruser;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{

    public function showTasks(Request $request)
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

      $tasksQuery = task::query();

      if(!empty($keyword))
      {
        $tasksQuery = task::where('title', 'LIKE', "%$keyword%");
      }
      

    if (in_array($sortColumn, $validUserSortColumns)) {
        $tasksQuery->join('registerusers', 'tasks.regiuser_id', '=', 'registerusers.regiuser_id')
                   ->orderBy("registerusers.$sortColumn", $sortDirection)
                   ->select('tasks.*');
    } else {
        $tasksQuery->orderBy($sortColumn, $sortDirection);
    }

    $tasks = $tasksQuery->paginate($perPage);

    $currentPageItems = $tasks->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    $tasks->setCollection($currentPageItems);

      return view('showalltasks', compact('tasks'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }    
    public function addTasks()
    {
        $employees = registeruser::where("usertype_id","3")->get();
        return view('addtasks',compact('employees'));
       
    }

    public function deleteTask($task_id)
    {
        $task = task::find($task_id);

        if ($task) {
            $task->delete();
            return redirect()->route('tasks.show')->with('success', 'The Task Has Been Deleted Successfully');
        } else {
            return redirect()->route('tasks.show')->with('error', 'Task not found');
        }
    }

    public function storeTask(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'regiuser_id' => 'required|string|exists:registerusers,regiuser_id',
            'title' => 'required|string|max:255',
            'description' => 'required|nullable|string',
            'status' => 'required|string|in:pending,in_progress,completed',
            'start_date' => 'required|date|before_or_equal:submit_date',
            'submit_date' => 'required|date|after_or_equal:start_date'
         ]);

         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $task = new task();
        $task->regiuser_id = $request->regiuser_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->start_date = $request->start_date;
        $task->submit_date = $request->submit_date;
        $task->save();

        return redirect()->route('tasks.show')->with('status','Task Has Been assign Successfully.');

    }

    public function updateTask($task_id)
    {
       if (!is_numeric($task_id)) {
          abort(404);
      }
       $tasks= task::find($task_id);
       $employees = registeruser::where("usertype_id","3")->get();

       if($tasks && $employees)
       {
          return view("updatetask",compact('tasks','employees'));
       }
       else{
          return redirect()->route('tasks.show')->with('error', 'User not found');
       }
   
    }

    public function updateTaskPage(Request $request,int $id)
    {
       $tasks = task::find($id);

       $tasks->regiuser_id = $request->regiuser_id;
       $tasks->title = $request->title;
       $tasks->description = $request->description;
       $tasks->status = $request->status;
       $tasks->start_date = $request->start_date;
       $tasks->submit_date = $request->submit_date;
       $tasks->save();

       return redirect()->route('tasks.show')->with('status','Task Has Been Updated Successfully.');

    }
}
