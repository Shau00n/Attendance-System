<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ログイン処理
Route::post('/login', [AuthController::class, 'login']);

// User関連のエンドポイント
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Attendance関連のエンドポイント
Route::get('/attendances', [AttendanceController::class, 'index']);
Route::get('/attendances/{id}', [AttendanceController::class, 'show']);
Route::post('/attendances', [AttendanceController::class, 'store']);
Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);

// Calendar関連のエンドポイント
Route::get('/calendars', [CalendarController::class, 'index']);
Route::get('/calendars/{id}', [CalendarController::class, 'show']);
Route::post('/calendars', [CalendarController::class, 'store']);
Route::put('/calendars/{id}', [CalendarController::class, 'update']);
Route::delete('/calendars/{id}', [CalendarController::class, 'destroy']);