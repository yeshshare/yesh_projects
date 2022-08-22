<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesBuController;
use App\Http\Controllers\EmployeesOfficeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusProjectController;
use App\Http\Controllers\ProjectEmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

/*Rotas MASTER*/
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('employeesBus', EmployeesBuController::class);
    Route::resource('employeesOffices', EmployeesOfficeController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('statusproject', StatusProjectController::class);
    Route::get('/list/projects', [App\Http\Controllers\ProjectController::class, 'getList'])->name('getListProjects');
    Route::get('/get/project/{$id}', [App\Http\Controllers\ProjectController::class, 'getProject'])->name('getProject');
    Route::get('/list/statusprojects', [App\Http\Controllers\StatusProjectController::class, 'getList'])->name('getListStatusProject');
    Route::get('/get/statusproject/{id}', [App\Http\Controllers\StatusProjectController::class, 'getProject'])->name('getStatusProject');      
    Route::get('/list/projectEmployees/{$id}', [App\Http\Controllers\ProjectEmployeeController::class, 'getList'])->name('getListProjectEmployees');
});


Route::prefix('employee')->group(function(){
    Route::get('/login', [App\Http\Controllers\EmployeeController::class, 'login'])->name('login_staff');
    Route::post('/doLogin', [App\Http\Controllers\EmployeeController::class, 'doLogin'])->name('doLogin');
    
    Route::middleware(['auth.company'])->group(function () {
        Route::get('/home', [App\Http\Controllers\EmployeeController::class, 'home'])->name('home_staff');
        Route::resource('users', UserController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('employeesBus', EmployeesBuController::class);
        Route::resource('employeesOffices', EmployeesOfficeController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('statusproject', StatusProjectController::class);
        Route::get('/list/projects', [App\Http\Controllers\ProjectController::class, 'getList'])->name('getListProjects');
        Route::get('/get/project/{id}', [App\Http\Controllers\ProjectController::class, 'getProject'])->name('getProject');   
        Route::get('/list/statusprojects/{project_id}', [App\Http\Controllers\StatusProjectController::class, 'getList'])->name('getListStatusProject');
        Route::get('/get/statusproject/{id}', [App\Http\Controllers\StatusProjectController::class, 'getProject'])->name('getStatusProject');   
        Route::get('/list/projectEmployees/{project_id}', [App\Http\Controllers\ProjectEmployeeController::class, 'getList'])->name('getListProjectEmployees');
    });
});
/*Rotas MASTER*/


