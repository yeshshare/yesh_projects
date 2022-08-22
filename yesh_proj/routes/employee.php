<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesBuController;
use App\Http\Controllers\EmployeesOfficeController;

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

Route::get('/login', [App\Http\Controllers\EmployeeController::class, 'login'])->name('login_staff');
Route::post('/doLogin', [App\Http\Controllers\EmployeeController::class, 'doLogin'])->name('doLogin');
Route::get('/home', [App\Http\Controllers\EmployeeController::class, 'home'])->name('home_staff');
Route::middleware(['auth.company'])->group(function () {
    
});
/*Rotas MASTER*/


