<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Home
Route::get('/', [HomeController::class, 'index']);

// Registration
Route::get('registration', [AuthController::class, 'registration']);
Route::post('registration_post', [AuthController::class, 'registration_post']);

// Login
Route::get('login', [AuthController::class, 'login']);
Route::post('login_post', [AuthController::class, 'login_post']);

// Forgot Password
Route::get('forgot', [AuthController::class, 'forgot']);
Route::post('forgot_post', [AuthController::class, 'forgot_post']);

// Reset Password
Route::get('reset/{token}', [AuthController::class, 'getReset']);
Route::post('reset_post/{token}', [AuthController::class, 'postReset']);

// Logout
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'superadmin'], function () {
    Route::get('superadmin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
});
