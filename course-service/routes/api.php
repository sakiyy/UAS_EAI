<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
Route::get('/my-courses', [CourseController::class, 'myCourses']);
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll']);

// Route::middleware('auth:api')->group(function () {
//     Route::get('/courses', [CourseController::class, 'index']);
//     Route::get('/courses/{id}', [CourseController::class, 'show']);
//     Route::post('/courses', [CourseController::class, 'store']);
//     Route::put('/courses/{id}', [CourseController::class, 'update']);
//     Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
// });

// Route::middleware('auth:api')->group(function () {
//     Route::get('/courses', [CourseController::class, 'index']);
//     Route::get('/courses/{id}', [CourseController::class, 'show']);
//     Route::post('/courses', [CourseController::class, 'store']);
// });
