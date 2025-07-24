<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salary;
use Auth;
class EmployeeSalaryController extends Controller
{
    public function showEmployeeSalary(Request $request)
    {
        $validSortColumns = ['salary_id','first_name','amount', 'pay_date'];
        $validUserSortColumns = ['first_name'];

        $keyword = $request->get('search');
        $perPage = 3;

      $sortColumn = $request->get('sort', 'salary_id');
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

      $salariesQuery = salary::query();

      if(!empty($keyword))
      {
        $salariesQuery = salary::where('first_name', 'LIKE', "%$keyword%");
      }


      $user = Auth::user();
        if ($user && $user->usertype_id == 3) {  
            $salariesQuery = $salariesQuery->where('regiuser_id', $user->regiuser_id);
        } else {
            abort(403, 'Unauthorized action.');
        }
      

    if (in_array($sortColumn, $validUserSortColumns)) {
        $salariesQuery->join('registerusers', 'salaries.regiuser_id', '=', 'registerusers.regiuser_id')
                   ->orderBy("registerusers.$sortColumn", $sortDirection)
                   ->select('salaries.*');
    } else {
        $salariesQuery->orderBy($sortColumn, $sortDirection);
    }

    $salaries = $salariesQuery->paginate($perPage);

    $currentPageItems = $salaries->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    $salaries->setCollection($currentPageItems);

      return view('showemployeesalary', compact('salaries'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }
}
