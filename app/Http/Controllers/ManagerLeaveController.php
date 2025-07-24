<?php

namespace App\Http\Controllers;

use App\Models\leave;
use Illuminate\Http\Request;
use Auth;
use DB;
class ManagerLeaveController extends Controller
{
    public function showAllLeaveReq(Request $request)
    {
        $validSortColumns = ['leave_id', 'first_name', 'leave_dates', 'reason', 'status'];
        $perPage = 4;
    
        $sortColumn = $request->get('sort', 'leave_id');
        $sortDirection = $request->get('direction', 'asc');
    
        if (!in_array($sortColumn, $validSortColumns)) {
            abort(404);
        }
    
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            abort(404);
        }

        $page = $request->input('page', 1);
        if (!is_numeric($page) || $page < 1) {
            abort(404);
        }
    
        $searchDate = $request->get('date');
    
        $leavesQuery = leave::query()
        ->leftJoin('registerusers', 'leaves.regiuser_id', '=', 'registerusers.regiuser_id')
        ->select('leaves.*', 'registerusers.first_name');
    
        if ($searchDate) {
            $leavesQuery->whereJsonContains('leave_dates', $searchDate);
        }
    
        if ($sortColumn === 'leave_dates') {
            $leavesQuery->orderByRaw("jsonb_extract_path_text(leave_dates::jsonb, '0') $sortDirection");
        } else {
            $leavesQuery->orderBy($sortColumn, $sortDirection);
        }
    
        $leaves = $leavesQuery->paginate($perPage);

        $currentPageItems = $leaves->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

        $leaves->setCollection($currentPageItems);

        $notifications = session('notifications') ?? [];

    
        return view('managershowallempleaves', compact('leaves'))
            ->with('i', ($request->input('page', 1) - 1) * $perPage);
    }

    public function accept(leave $leave)
    {
        $leave->status = 'approved';
        $leave->save();

        $notification = [
            'type' => 'success',
            'icon' => 'fas fa-check',
            'date' => now()->format('F j, Y'),
            'message' => 'Your leave request has been approved.'
        ];

        $this->storeNotificationInSession($leave->regiuser_id, $notification);

        return redirect()->back()->with('success', 'Leave request accepted.');
    }

    public function reject(leave $leave)
    {
        $leave->status = 'rejected';
        $leave->save();

        $notification = [
            'type' => 'danger',
            'icon' => 'fas fa-times',
            'date' => now()->format('F j, Y'),
            'message' => 'Your leave request has been rejected.'
        ];
    
        $this->storeNotificationInSession($leave->regiuser_id, $notification);
        

        return redirect()->back()->with('success', 'Leave request rejected.');
    }

    private function storeNotificationInSession($userId, $notification)
    {
        $notifications = session()->get('notifications', []);
        if (!isset($notifications[$userId])) {
            $notifications[$userId] = [];
        }
        $notifications[$userId][] = $notification;
        session()->put('notifications', $notifications);
    }

    public function clearNotifications()
    {
        $userId = Auth::user()->regiuser_id;
        session()->forget('notifications.' . $userId);
        return response()->json(['status' => 'success']);
    }
}
