<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeContoller;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CompanyEmployeeController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Contracts\Cache\Store;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


use function PHPUnit\Framework\fileExists;

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
Auth::routes();
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::group(['middleware' => ['auth', 'role:company-admin']], function() {
    Route::get('company_admin/profile', [CompanyProfileController::class, 'index'])->name('company.profile');
    Route::get('company_admin/employees', [CompanyEmployeeController::class, 'employeelist'])->name('company.employee');
});


Route::group(['middleware' => ['auth', 'role:super-admin']], function() {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/admin', [AdminDashboardController::class, 'dashboardData'])->name('superadmin');
    Route::resource('/companies', CompanyController::class);
    Route::resource('/employees', EmployeeContoller::class);
    Route::put('/employees/{employee}/status', [EmployeeContoller::class, 'updateStatus'])->name('employees.updateStatus');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');    
});
