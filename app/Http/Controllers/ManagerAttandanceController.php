<?php

namespace App\Http\Controllers;
use App\Models\attendance;
use App\Models\registeruser;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class ManagerAttandanceController extends Controller
{
    public function showAllAttandance(Request $request)
    {
        $validSortColumns = ['attendance_id','first_name','regiuser_id','date','status'];
        $validUserSortColumns = ['first_name','regiuser_id'];

        $keyword = $request->get('search');
        $searchDate = $request->get('date');
        $perPage = 3;

      $sortColumn = $request->get('sort', 'attendance_id');
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

      $tasksQuery = attendance::query();

      if(!empty($keyword))
      {
        $tasksQuery->join('registerusers', 'attendances.regiuser_id', '=', 'registerusers.regiuser_id')
                   ->where('registerusers.first_name', 'LIKE', "%$keyword%")
                   ->select('attendances.*');
      }

      if (!empty($searchDate)) {
        $tasksQuery->whereDate('date', $searchDate);
    }
      

    if (in_array($sortColumn, $validUserSortColumns)) {
        $tasksQuery->join('registerusers', 'attendances.regiuser_id', '=', 'registerusers.regiuser_id')
                   ->orderBy("registerusers.$sortColumn", $sortDirection)
                   ->select('attendances.*');
    } else {
        $tasksQuery->orderBy($sortColumn, $sortDirection);
    }

    $attendances  = $tasksQuery->paginate($perPage);

    $currentPageItems = $attendances->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    $attendances ->setCollection($currentPageItems);

      return view('showallattandance', compact('attendances'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }
    public function showAttandance()
    {
        $employees = registeruser::where("usertype_id","3")->get();
        return view('addattandance',compact('employees'));
    }

    public function storeAttandance(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'date' => 'required|date',
            'attendance.*.status' => 'required|string|in:present,absent,leave',
            
         ]);

         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $date = $request->input('date');
        $attendances = $request->input('attendance');

        foreach ($attendances as $attendanceData) {
            attendance::create([
                'regiuser_id' => $attendanceData['regiuser_id'],
                'date' => $date,
                'status' => $attendanceData['status'],
            ]);
        }

        return redirect()->route('show.allattandance')->with('status','Attandance Taken Successfully.');

    }

    public function deleteAttandance($attendance_id)
    {

        $attendance = Attendance::find($attendance_id);

        if ($attendance) {
            $attendance->delete();
            return redirect()->route('show.allattandance')->with('success', 'The Attendance Record Has Been Deleted Successfully');
        } else {
            return redirect()->route('show.allattandance')->with('error', 'Attendance record not found');
        }

    }

    public function updateAttandance($attendance_id)
    {
       if (!is_numeric($attendance_id)) {
          abort(404);
      }
      $attendance= attendance::find($attendance_id);
       $employees = registeruser::where('regiuser_id', $attendance->regiuser_id)->first();

       if($attendance && $employees)
       {
          return view("updateattendance",compact('attendance','employees'));
       }
       else{
          return redirect()->route('show.allattandance')->with('error', 'User not found');
       }
   
    }

    public function updateAttandancePage(Request $request,int $id)
    {
       $attendance = attendance::find($id);

       $attendance->regiuser_id = $request->regiuser_id;
       $attendance->date = $request->date;
       $attendance->status = $request->status;
       $attendance->save();

       return redirect()->route('show.allattandance')->with('status','Attendance Has Been Updated Successfully.');

    }
}
