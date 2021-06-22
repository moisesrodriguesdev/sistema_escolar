<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Team\TeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::resource('students', StudentController::class);
Route::resource('teams', TeamController::class);
Route::resource('schools', SchoolController::class);
