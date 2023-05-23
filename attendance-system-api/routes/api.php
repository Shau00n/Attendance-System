<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;

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

// api.php
// ユーザー登録 
Route::post('/register', [AuthController::class, 'register']);
// ログイン 
Route::post('/login', [AuthController::class, 'login']);
// ログアウト 
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// User関連のエンドポイント（認証が必要） 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
});

// Attendance関連のエンドポイント（認証が必要） 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('attendances', AttendanceController::class);
});

// Calendar関連のエンドポイント（認証が必要） 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('calendars', CalendarController::class);
});

// // User関連のエンドポイント（認証が必要） 
// Route::middleware('auth:sanctum')->group(function () { 
//     Route::get('/users', [UserController::class, 'index']); 
//     Route::get('/users/{id}', [UserController::class, 'show']); 
//     Route::post('/users', [UserController::class, 'store']); 
//     Route::put('/users/{id}', [UserController::class, 'update']); 
//     Route::delete('/users/{id}', [UserController::class, 'destroy']); 
// });

// // Attendance関連のエンドポイント（認証が必要） 
// Route::middleware('auth:sanctum')->group(function () { 
//     Route::get('/attendances', [AttendanceController::class, 'index']); 
//     Route::get('/attendances/{id}', [AttendanceController::class, 'show']); 
//     Route::post('/attendances', [AttendanceController::class, 'store']); 
//     Route::put('/attendances/{id}', [AttendanceController::class, 'update']); 
//     Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']); 
// });

// // Calendar関連のエンドポイント（認証が必要） 
// Route::middleware('auth:sanctum')->group(function () { 
//     Route::get('/calendars', [CalendarController::class, 'index']); 
//     Route::get('/calendars/{id}', [CalendarController::class, 'show']); 
//     Route::post('/calendars', [CalendarController::class, 'store']); 
//     Route::put('/calendars/{id}', [CalendarController::class, 'update']); 
//     Route::delete('/calendars/{id}', [CalendarController::class, 'destroy']); 
// });