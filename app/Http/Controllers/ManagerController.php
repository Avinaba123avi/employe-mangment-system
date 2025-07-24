<?php

namespace App\Http\Controllers;
use App\Models\leave;
use App\Models\registeruser;
use Illuminate\Http\Request;
use App\Models\salary;

class ManagerController extends Controller
{
    public function managerDashboard()
    {
        //$admins = registeruser::where("usertype_id","1")->count();
        $managers = registeruser::where("usertype_id","2")->count();
        $employees = registeruser::where("usertype_id","3")->count();
        $totalusers = registeruser::count();
        $salaries = salary::whereHas('registerUser', function($query) {
            $query->where('usertype_id', 3);
        })->sum('amount');
        $leaves = leave::count();
       return view('manager', compact('managers','employees','totalusers','salaries','leaves'));
    }
}
