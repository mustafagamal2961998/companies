<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;


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
    return view('auth.login');
});
Route::get('/new_comp', function () {
    return view('new_comp');
})->name('new_comp')->middleware(['auth:admin']);

Auth::routes();

Route::resource('cpanel',CompanyController::class)->middleware(['auth:admin']);

Route::resource('employee',EmployeeController::class)->middleware(['auth:admin']);

