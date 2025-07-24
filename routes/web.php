<?php

use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\EmployeeAttandanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeCrudController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ManagerAttandanceController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerCrudController;
use App\Http\Controllers\ManagerLeaveController;
use App\Http\Controllers\ManagerSalaryController;
use App\Http\Controllers\myusercontroller;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ResetCodeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\ManagerMiddleware;
use App\Models\registeruser;
use Illuminate\Support\Facades\Route;
use App\Models\users;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('user');
});

  Route::get('/forgotpassword', function () {
    return view('forgotpassword');
})->name('forpass');


  Route::get('/resetcode', function () {
    return view('resetcode');
})->name('recode');



  Route::get('/newpassword', function () {
    return view('newpassword');
})->name('newpass');



//Route::post('/register',[RegisterUserController::class,'register'])->name('user.register');
//Route::post('/',[RegisterUserController::class,'register'])->name('user.logregister');
// Route::post('/login',[UserLoginController::class,'login'])->name('user.login');



Route::post('/newpassword',[ResetCodeController::class,'resetcode'])->name('user.resetcode');
Route::post('/',[NewPasswordController::class,'newpassword'])->name('user.newpassword');
Route::post('/resetcode',[ForgotPasswordController::class,'forgetpassword'])->name('user.forgetpassword');

//Route::view('newuser','/adduser');


Route::get('captcha-image', [UserLoginController::class, 'captchaImage'])->name('captcha.image');
Route::get('refresh-captcha', [UserLoginController::class, 'refreshCaptcha'])->name('captcha.refresh');





//Route::get('/updatepage/{id}',[AdminDashboard::class,'updatePage'])->name('update.page');
// Route::get('/mysingleuser/{id}',[AdminDashboard::class,'mysingleuser'])->name('user.view');
// // Route::post('/add',[AdminDashboard::class,'adduser'])->name('addUser');
// // Route::get('/update',[AdminDashboard::class,'updateuser'])->name('update.user');
// Route::get('/delete/{id}',[AdminDashboard::class,'deleteuser'])->name('delete.user');
// Route::post('/user', [AdminDashboard::class, 'processRegistration']);



  Route::group(['middleware' => 'currentDashboard'], function () {
    Route::get('/', function () {
    return view('login');
})->name('login');
});

Route::group(['middleware' => 'currentDashboard'], function () {
Route::get('/register', function () {
    return view('register');
})->name('regi');
});

// Route::group(['middleware' => 'currentDashboard'], function () {
//   Route::get('/adduser', function () {
//       return view('adduser');
//   })->name('add');
//   });
    Route::post('/register',[RegisterUserController::class,'register'])->name('user.register');
    Route::post('/login',[UserLoginController::class,'login'])->name('user.login');


Route::group(["middleware" => ['auth', 'admin:1']], function () {
    Route::get('/admin', [AdminDashboard::class, 'myuser'])->name('admin.dashboard');
    Route::get('/users/admincrud',[AdminCrudController::class,'showUsers'])->name('admin.crud');
    Route::get('/showsingleuser/{id}',[AdminCrudController::class,'singleUser'])->name('view.user');
    Route::get('/deleteuser/{id}',[AdminCrudController::class,'deleteUser'])->name('user.delete');
    Route::post('/adduser',[AdminCrudController::class,'addUser'])->name('add.user');
    Route::get('/updateUser/{id}',[AdminCrudController::class,'updateUser'])->name('update.user')->whereNumber('id');
    Route::post('/updatePage/{id}',[AdminCrudController::class,'updatePage'])->name('update.page');
    Route::get('/logout',[UserLoginController::class,'logout'])->name('user.logout');


    
    Route::get('/salaries/showallSalaries', [SalaryController::class, 'showAllSalaries'])->name('show.salary');
    Route::post('/addsal', [SalaryController::class, 'storeSalary'])->name('salary.store');
    Route::get('/salaries/addSalaries', [SalaryController::class, 'addSalary'])->name('add.salary');

    
    Route::get('/deleteSalaries/{id}', [SalaryController::class, 'deleteUserSalary'])->name('delete.salary');
    Route::get('/updateSalaries/{id}', [SalaryController::class, 'updateSalary'])->name('update.salary');
    Route::post('/updateSalaryPage/{id}',[SalaryController::class,'updateSalaryPage'])->name('update.salarypage');
   
    
    Route::view('/users/newuser','/adduser');

    
  });

  Route::group(['middleware' => 'checkPermission:update role'], function () {
    Route::get('/updateUserType/{id}',[AdminRolesController::class,'updateUserType'])->name('update.usertype');
    Route::post('/updatePageType/{id}',[AdminRolesController::class,'updatePageType'])->name('update.pagetype');
  });

  Route::group(['middleware' => 'checkPermission:view role'], function () {
    Route::get('/roles/adminrole', [AdminRolesController::class, 'showUserType'])->name('admin.roles');
  });

  Route::group(['middleware' => 'checkPermission:delete role'], function () {
    Route::get('/deleteusertype/{id}',[AdminRolesController::class,'deleteUserType'])->name('usertype.delete');

  });
  
  Route::group(['middleware' => 'checkPermission:create role'], function () {
    Route::post('/addType',[AdminRolesController::class,'addUserType'])->name('addUserType');
    Route::view('/roles/usertype','/addroles');

  });

  Route::group(['middleware' => 'checkPermission:update permission'], function () {
    Route::get('/updatepermissions/{id}', [PermissionController::class, 'updatePermission'])->name('update.premission');
    Route::post('/updatePagePermission/{id}',[PermissionController::class,'updatePagePermission'])->name('update.pagepermission');
    Route::put('/givepermissiontorole/{id}',[AdminRolesController::class,'givePermissionToRole'])->name('give.permissiontorole');
  });

  Route::group(['middleware' => 'checkPermission:view permission'], function () {
    Route::get('/premissions/showpremission', [PermissionController::class, 'showAllPermissions'])->name('showall.permission');
    Route::get('/premissions/addpremission', [PermissionController::class, 'showPermission'])->name('show.permission');
  });

  Route::group(['middleware' => 'checkPermission:delete permission'], function () {
    Route::get('/deletePremissions/{id}', [PermissionController::class, 'deletePermissions'])->name('delete.premission');
  });
  
  Route::group(['middleware' => 'checkPermission:create permission'], function () {
    Route::get('/addpremission', [PermissionController::class, 'showPermission'])->name('show.permission');
    Route::get('/addpermissiontorole/{id}',[AdminRolesController::class,'addPermissionToRole'])->name('add.permissiontorole');
    Route::post('/createpremission', [PermissionController::class, 'addPermissions'])->name('add.permission');
  
  });
  
  
     


  

  Route::get('/adminrole', [AdminRolesController::class, 'showUserType'])->name('admin.roles');

  Route::group(["middleware" => ['auth', 'manager:2']], function () {
  Route::get('/manager', [ManagerController::class, 'managerDashboard'])->name('manager.dashboard');
  Route::get('/employees/managercrud',[ManagerCrudController::class,'showEmployess'])->name('manager.crud');
  Route::get('/showsingleemployee/{id}',[ManagerCrudController::class,'singleEmployee'])->name('view.employee');
  Route::post('/addemp',[ManagerCrudController::class,'addEmployees'])->name('addEmplyee');
  Route::view('/employees/newemp','/addemployees');

  Route::get('/updateEmployee/{id}',[ManagerCrudController::class,'updateEmployee'])->name('update.employee');
  Route::get('/deleteemployee/{id}',[ManagerCrudController::class,'deleteEmployee'])->name('employee.delete');
  Route::post('/updateEmplyoeePage/{id}',[ManagerCrudController::class,'updateEmpPage'])->name('update.employeepage');

  Route::get('/createtasks', [TaskController::class, 'addTasks'])->name('tasks.create');
  Route::post('/addtask', [TaskController::class, 'storeTask'])->name('tasks.store');
  Route::get('/tasks', [TaskController::class, 'showTasks'])->name('tasks.show');
  Route::get('/updateTask/{id}',[TaskController::class,'updateTask'])->name('update.task');
  Route::get('/deletetask/{id}',[TaskController::class,'deleteTask'])->name('delete.task');
  Route::post('/updateTaskPage/{id}',[TaskController::class,'updateTaskPage'])->name('update.taskpage');

  
  Route::get('/showmanagersalary', [ManagerSalaryController::class, 'showManagerSalary'])->name('salary.manager');

  Route::get('/addattandance', [ManagerAttandanceController::class, 'showAttandance'])->name('show.attandance');
  Route::post('/showattandnce', [ManagerAttandanceController::class, 'storeAttandance'])->name('store.attandance');
  
  Route::get('/showallattandance', [ManagerAttandanceController::class, 'showAllAttandance'])->name('show.allattandance');
  
  Route::get('/deleteattandance/{id}', [ManagerAttandanceController::class, 'deleteAttandance'])->name('delete.attandance');

  Route::get('/updateattandance/{id}', [ManagerAttandanceController::class, 'updateAttandance'])->name('update.attandance');
  Route::post('/updateAttandancePage/{id}',[ManagerAttandanceController::class,'updateAttandancePage'])->name('update.attandancepage');

  // Route::get('/showallleaveReq', [ManagerLeaveController::class, 'showAllLeaveReq'])->name('show.leavereq');
  Route::put('/leaves/{leave}/accept', [ManagerLeaveController::class, 'accept'])->name('leave.accept');
  Route::put('/leaves/{leave}/reject', [ManagerLeaveController::class, 'reject'])->name('leave.reject');
  

  Route::get('/clear-notifications', [ManagerLeaveController::class, 'clearNotifications']);

  });

  
  Route::group(['middleware' => 'checkPermission:view leave applications'], function () {
  Route::get('/showallleaveReq', [ManagerLeaveController::class, 'showAllLeaveReq'])->name('show.leavereq');

  });

  Route::group(["middleware" => ['auth', 'employee:3']], function () {
  Route::get('/employee', [EmployeeController::class, 'employeeDashboard'])->name('employee.dashboard');
  Route::get('/employeecrud',[EmployeeCrudController::class,'showSingleEmp'])->name('emp.crud');
  
 
  Route::get('/showempsalary', [EmployeeSalaryController::class, 'showEmployeeSalary'])->name('salary.employee');
  Route::get('/showempattandance', [EmployeeAttandanceController::class, 'showEmpAttendance'])->name('attandance.employee');

  
  Route::get('/showEmpLeave', [EmployeeLeaveController::class, 'showLeave'])->name('leave.employee');
  Route::post('/addLeave', [EmployeeLeaveController::class, 'storeLeave'])->name('leave.store');
  Route::get('/showleavedetails', [EmployeeLeaveController::class, 'showLeaveDetails'])->name('leave.details');

  Route::get('/clear-notifications', [EmployeeLeaveController::class, 'clearNotifications']);

  });

//   Route::get('/createtasks', [TaskController::class, 'addTasks'])->name('tasks.create');
//   Route::post('/addtask', [TaskController::class, 'storeTask'])->name('tasks.store');
//   Route::get('/tasks', [TaskController::class, 'showTasks'])->name('tasks.show');
//   Route::get('/updateTask/{id}',[TaskController::class,'updateTask'])->name('update.task');
//   Route::get('/deletetask/{id}',[TaskController::class,'deleteTask'])->name('delete.task');
//   Route::post('/updateTaskPage/{id}',[TaskController::class,'updateTaskPage'])->name('update.taskpage');

  Route::get('/showemptask', [EmployeeTaskController::class, 'showEmpTask'])->name('emptasks.show');
  Route::get('/updateTaskStatus/{id}',[EmployeeTaskController::class,'updateTaskStatus'])->name('update.taskstatus');
  Route::post('/updateTaskPageStatus/{id}',[EmployeeTaskController::class,'updateTaskPageStatus'])->name('updatestatus.task');

//   Route::get('/addattandance', [ManagerAttandanceController::class, 'showAttandance'])->name('show.attandance');
//   Route::post('/showattandnce', [ManagerAttandanceController::class, 'storeAttandance'])->name('store.attandance');

  Route::get('/logout',[UserLoginController::class,'logout'])->name('user.logout');


// Route::get('/updatepage/{id}',[myusercontroller::class,'updatePage'])->name('update.page');
// Route::get('/myuser',[myusercontroller::class,'myuser'])->name('home');
// Route::get('/mysingleuser/{id}',[myusercontroller::class,'mysingleuser'])->name('view.user');
// Route::post('/add',[myusercontroller::class,'adduser'])->name('addUser');
// Route::get('/update/{id}',[myusercontroller::class,'updateuser'])->name('update.user');
// Route::get('/delete/{id}',[myusercontroller::class,'deleteuser'])->name('delete.user');
// Route::post('/user', [UserController::class, 'processRegistration']);