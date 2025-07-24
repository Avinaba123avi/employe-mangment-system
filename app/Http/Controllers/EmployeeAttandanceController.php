<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\attendance;
use Illuminate\Http\Request;

class EmployeeAttandanceController extends Controller
{
    public function showEmpAttendance(Request $request)
    {
        $validSortColumns = ['attendance_id','date','status'];

        $keyword = $request->get('search');
        $searchDate = $request->get('date');
        $perPage = 3;

      $sortColumn = $request->get('sort', 'attendance_id');
      $sortDirection = $request->get('direction', 'asc');

      if (!in_array($sortColumn,$validSortColumns)) {
        abort(404);
    }

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            abort(404);
        }

      $page = $request->input('page', 1);
      if (!is_numeric($page) || $page < 1) {
          abort(404);
      }

      $attendanceQuery= attendance::query();

      if ($searchDate) {
        $attendanceQuery->where('date', $searchDate);
    }

      $user = Auth::user();
        if ($user && $user->usertype_id == 3) {  
            $attendanceQuery = $attendanceQuery->where('regiuser_id', $user->regiuser_id);
        } else {
            abort(403, 'Unauthorized action.');
        }
      
        $attendanceQuery->orderBy($sortColumn, $sortDirection);

    $attendances = $attendanceQuery->paginate($perPage);

    $currentPageItems = $attendances->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    $attendances->setCollection($currentPageItems);

      return view('singleempattendance', compact('attendances'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }
}
