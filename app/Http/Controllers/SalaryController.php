<?php

namespace App\Http\Controllers;

use App\Models\salary;
use Illuminate\Http\Request;
use App\Models\registeruser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class SalaryController extends Controller
{

    public function showAllSalaries(Request $request)
    {
        $validSortColumns = ['salary_id','usertype_id','first_name','amount', 'pay_date'];
        $validUserSortColumns = ['first_name','usertype_id'];

        $keyword = $request->get('search');
        $perPage = 4;

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

      $tasksQuery = salary::query();

      if(!empty($keyword))
      {
        $tasksQuery = salary::where('first_name', 'LIKE', "%$keyword%");
      }
      

    if (in_array($sortColumn, $validUserSortColumns)) {
        $tasksQuery->join('registerusers', 'salaries.regiuser_id', '=', 'registerusers.regiuser_id')
                    ->whereIn('registerusers.usertype_id', [2, 3])
                   ->orderBy("registerusers.$sortColumn", $sortDirection)
                   ->select('salaries.*');
    } else {
        $tasksQuery->orderBy($sortColumn, $sortDirection);
    }

    //$salaries = $tasksQuery->paginate($perPage);
    $salaries = $tasksQuery->paginate($perPage, ['*'], 'page', $page);


    // $currentPageItems = $salaries->getCollection()->sortBy($sortColumn, SORT_REGULAR, $sortDirection == 'desc')->values();

    // $salaries->setCollection($currentPageItems);


    $currentPageItems = collect($salaries->items());
    if ($sortDirection === 'asc') {
        $currentPageItems = $currentPageItems->sortBy($sortColumn);
    } else {
        $currentPageItems = $currentPageItems->sortByDesc($sortColumn);
    }
    $salaries->setCollection($currentPageItems->values());

      return view('showallsalaries', compact('salaries'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }
    
    public function addSalary()
    {
        $users = registeruser::whereIn("usertype_id",[2,3])->with('userType')->get();
        return view('addsalaries',compact('users'));
    }

    public function storeSalary(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'regiuser_id' => 'required|string|exists:registerusers,regiuser_id',
            'amount' => 'required|integer|min:1|max:100000',
            'pay_date' => 'required|date',
         ]);

         if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $existingSalary = salary::where('regiuser_id', $request->regiuser_id)
                            ->where('pay_date', $request->pay_date)
                            ->first();

        if ($existingSalary) {
            $validate->errors()->add('pay_date', 'Salary for this user on this date already exists.');
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $salary = new salary();
        $salary->regiuser_id = $request->regiuser_id;
        $salary->amount = $request->amount;
        $salary->pay_date = $request->pay_date;
        $salary->save();

        return redirect()->route('show.salary')->with('status','Sallary Has Been added Successfully.');

    }

    public function deleteUserSalary(int $id)
   {
      $user = DB::table("salaries")->where("salary_id",$id)->delete();
      if($user){
         return redirect()->route('show.salary')->with('success','The Salary Has Been Deleted Successfully');
      }
   }

   public function updateSalary($salary_id)
    {
       if (!is_numeric($salary_id)) {
          abort(404);
      }
       $salarys= salary::find($salary_id);
       $users = registeruser::whereIn("usertype_id",[2,3])->get();

       if($salarys && $users)
       {
          return view('updatesalary',compact('salarys','users'));
       }
       else{
          return redirect()->route('tasks.show')->with('error', 'User not found');
       }
   
    }

    public function updateSalaryPage(Request $request,int $id)
    {
       $salary = salary::find($id);

        $salary->regiuser_id = $request->regiuser_id;
        $salary->amount = $request->amount;
        $salary->pay_date = $request->pay_date;
        $salary->save();

       return redirect()->route('show.salary')->with('status','Salary Has Been Updated Successfully.');

    }

}
