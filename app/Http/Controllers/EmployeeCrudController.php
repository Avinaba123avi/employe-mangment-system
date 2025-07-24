<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeCrudController extends Controller
{
    public function showSingleEmp()
    {
        return view('employeecrud');
    }
}
