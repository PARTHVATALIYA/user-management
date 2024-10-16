<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('registration', [AuthenticationController::class, 'registrationForm'])->name('registrationForm');
Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::delete('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('forgotPassword', [AuthenticationController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
Route::get('user/verified/{token}', [AuthenticationController::class, 'mailVerfication'])->name('user.verified');

Route::get('admin/dashboard', [AdminController::class , 'showDashboard'])->name('admin.dashboard')->middleware(CheckUserRole::class . ':admin');
Route::get('users', [AdminController::class, 'getUser'])->name('users')->middleware(CheckUserRole::class . ':admin');
Route::get('edit/user/{id}', [AdminController::class, 'editUserForm'])->name('edit.user')->middleware(CheckUserRole::class . ':admin');
Route::put('edit/{id}', [AdminController::class, 'editUser'])->name('edit')->middleware(CheckUserRole::class . ':admin');
Route::get('approve/{id}', [AdminController::class, 'approveUser'])->name('user.approve')->middleware(CheckUserRole::class . ':admin');
Route::get('user/status/{id}', [AdminController::class, 'userStatus'])->name('user.status')->middleware(CheckUserRole::class . ':admin');

Route::get('user/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard')->middleware(CheckUserRole::class . ':user');
Route::get('user/profile', [UserController::class, 'getProfile'])->name('user.profile')->middleware(CheckUserRole::class . ':user');
Route::get('edit/profile/{id}', [UserController::class, 'editProfile'])->name('edit.profile')->middleware(CheckUserRole::class . ':user');