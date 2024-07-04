<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserManageTableController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserLoginController::class,'index'])->name('user.login');
Route::post('user/post-login', [UserLoginController::class, 'postLogin'])->name('user.login.post');
Route::get('user/logout', [UserLoginController::class,'logout'])->name('user.logout');

Route::get('user/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');

Route::get('user/profile', [UserProfileController::class,'index'])->middleware('auth')->name('user.profile');
Route::post('user/profile/update', [UserProfileController::class,'update'])->middleware('auth')->name('user.profile.update');

Route::post('user/profile-picture/update', [UserProfileController::class,'updateprofilepicture'])->middleware('auth')->name('user.profilepicture.update');
Route::post('user/profile-picture/delete', [UserProfileController::class, 'deleteprofilepicture'])->middleware('auth')->name('user.profilepicture.delete');

Route::get('user/password', [UserProfileController::class,'changepassword'])->middleware('auth')->name('user.password');
Route::post('user/password/update', [UserProfileController::class,'updatepassword'])->middleware('auth')->name('user.password.update');



Route::get('admin/dashboard', [AdminDashboardController::class,'index'])->middleware('admin')->name('admin.dashboard');

Route::get('admin', [AdminLoginController::class,'index'])->name('admin.login');
Route::post('admin/post-login', [AdminLoginController::class, 'postLogin'])->name('admin.login.post');
Route::get('admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');

Route::get('admin/profile', [AdminProfileController::class,'index'])->middleware('admin')->name('admin.profile');
Route::post('admin/profile/update', [AdminProfileController::class,'update'])->middleware('admin')->name('admin.profile.update');

Route::get('admin/password', [AdminProfileController::class,'changepassword'])->middleware('admin')->name('admin.password');
Route::post('admin/password/update', [AdminProfileController::class,'updatepassword'])->middleware('admin')->name('admin.password.update');

Route::post('admin/profile-picture/update', [AdminProfileController::class,'updateprofilepicture'])->middleware('admin')->name('admin.profilepicture.update');
Route::post('admin/profile-picture/delete', [AdminProfileController::class, 'deleteprofilepicture'])->middleware('admin')->name('admin.profilepicture.delete');

Route::get('admin/manage/users/list', [UserManageTableController::class,'UserList'])->middleware('admin')->name('admin.manage.users.list');
Route::get('admin/manage/users', [UserManageTableController::class,'index'])->middleware('admin')->name('admin.manage.users');
Route::post('admin/manage/users/store', [UserManageTableController::class, 'store'])->middleware('admin')->name('admin.manage.users.store');
