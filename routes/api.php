<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\TaskController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\ProjectController;


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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('v1/users', UserController::class);
    Route::apiResource('v1/projects', ProjectController::class);
    Route::apiResource('v1/tasks', TaskController::class);
    Route::get('v1/taskByUser', [TaskController::class, 'taskByUser']);
});
