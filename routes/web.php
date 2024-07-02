<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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

Route::get('user/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');
Route::get('user/logout',[UserDashboardController::class,'logout'])->name('user.logout');

Route::get('user/profile',[UserProfileController::class,'index'])->middleware('auth')->name('user.profile');
Route::post('user/profile/update',[UserProfileController::class,'update'])->middleware('auth')->name('user.profile.update');

Route::post('user/profile-picture/update',[UserProfileController::class,'updateprofilepicture'])->middleware('auth')->name('user.profilepicture.update');
Route::post('user/profile-picture/delete', [UserProfileController::class, 'deleteprofilepicture'])->middleware('auth')->name('user.profilepicture.delete');

Route::get('user/password',[UserProfileController::class,'changepassword'])->middleware('auth')->name('user.password');
Route::post('user/password/update',[UserProfileController::class,'updatepassword'])->middleware('auth')->name('user.password.update');

Route::get('admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
