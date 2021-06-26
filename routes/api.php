<?php

use App\Http\Controllers\Api\Student\StudentController;
use App\Http\Controllers\Api\Team\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\School\SchoolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'schools'], function() {
    Route::get('/', [SchoolController::class, 'index'])->name('api.schools.index');
    Route::post('/', [SchoolController::class, 'store'])->name('api.schools.store');
    Route::get('/{id}', [SchoolController::class, 'show'])->name('api.schools.show');
    Route::delete('/{id}', [SchoolController::class, 'destroy'])->name('api.schools.destroy');
});

Route::group(['prefix' => 'students'], function() {
    Route::get('/', [StudentController::class, 'index'])->name('api.students.index');
    Route::post('/', [StudentController::class, 'store'])->name('api.students.store');
    Route::get('/{id}', [StudentController::class, 'show'])->name('api.students.show');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('api.students.destroy');
});

Route::group(['prefix' => 'teams'], function() {
    Route::get('/', [TeamController::class, 'index'])->name('api.teams.index');
    Route::post('/', [TeamController::class, 'store'])->name('api.teams.store');
    Route::get('/{id}', [TeamController::class, 'show'])->name('api.teams.show');
    Route::delete('/{id}', [TeamController::class, 'destroy'])->name('api.teams.destroy');
});
