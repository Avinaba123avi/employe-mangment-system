<?php

namespace App\Http\Controllers;
use App\Models\leave;
use App\Models\salary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\registeruser;
class EmployeeController extends Controller
{
    public function employeeDashboard()
    {
        $user = Auth::user();
        $taskCount = $user->tasks()->count();
        $salary = salary::where('regiuser_id', $user->regiuser_id)->orderBy('pay_date', 'desc')->first();
        $leaves = leave::where('regiuser_id', $user->regiuser_id)->count();
        return view('employee', compact('taskCount','salary','leaves'));

    }
}

