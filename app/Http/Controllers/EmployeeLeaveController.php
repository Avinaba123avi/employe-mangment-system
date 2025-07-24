<?php

namespace App\Http\Controllers;

use App\Models\leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
class EmployeeLeaveController extends Controller
{
    public function showLeave()
    {
        return view('addempleave');
    }

    public function storeLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_dates' => 'required|string',
            'reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $leaveDatesArray = explode(',', $request->leave_dates);

        $leave = new leave();
        $leave->regiuser_id = Auth::user()->regiuser_id;
        $leave->leave_dates = json_encode($leaveDatesArray);
        $leave->reason = $request->reason;
        $leave->status = 'pending';
        $leave->save();

        $employeeName = Auth::user()->first_name . '  ' . Auth::user()->last_name;

        $notification = [
            'type' => 'warning', 
            'icon' => 'fas fa-exclamation-triangle',
            'date' => now()->format('F j, Y'),
            'message' => $employeeName . 'Leave application submitted for approval.'
        ];

        
        session()->push('notifications', $notification);

        return redirect()->route('leave.details')->with('success', 'Leave request submitted successfully.');
    }

    public function showLeaveDetails(Request $request)
    {

        $validSortColumns = ['leave_id','leave_dates','reason','status'];

        
        $searchDate = $request->get('date');
        $perPage = 4;

      $sortColumn = $request->get('sort', 'leave_id');
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

      $leavesQuery= leave::query();

      if ($searchDate) {
        
        $leavesQuery->whereJsonContains('leave_dates', $searchDate);
    }

      $user = Auth::user();
        if ($user && $user->usertype_id == 3) {  
            $leavesQuery = $leavesQuery->where('regiuser_id', $user->regiuser_id);
        } else {
            abort(403, 'Unauthorized action.');
        }

        if ($sortColumn === 'leave_dates') {
            $leavesQuery->orderByRaw("jsonb_extract_path_text(leave_dates::jsonb, '0') $sortDirection");
        }
        else{
            $leavesQuery->orderBy($sortColumn, $sortDirection);
        }
      

        $leaves = $leavesQuery->paginate($perPage);

    $currentPageItems = $leaves->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    $leaves->setCollection($currentPageItems);

    $notifications = session('notifications') ?? [];

      return view('showempleaves', compact('leaves','notifications'))->with('i', ($request->input('page', 1) - 1) * $perPage);

    }

    public function clearNotifications()
    {
        $userId = Auth::user()->regiuser_id;
        session()->forget('notifications.' . $userId);
        return response()->json(['status' => 'success']);
    }
}
