<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserManageTableController;
use App\Http\Controllers\Auth\ProfileController;

use App\Http\Controllers\User\CustomerSiteController;
use App\Http\Controllers\User\MonitoringController;
use App\Http\Controllers\User\CustomerSiteTableController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/', 'auth.login')->middleware('guest');

Auth::routes(['register' => false, 'reset' => false]);

/********** USER **********/
Route::get('user/site-tracking', [MonitoringController::class, 'index'])->middleware('auth')->name('home');
Route::get('user/site-tracking/customer_sites/{customer_site}', [CustomerSiteController::class, 'show'])->middleware('auth')->name('customer_sites.show');
Route::get('user/site-tracking/customer_sites/{customer_site}/timeline', [CustomerSiteController::class, 'timeline'])->middleware('auth')->name('customer_sites.timeline');

Route::get('user/site-tracking/customersite/list', [CustomerSiteTableController::class,'CustomerSiteList'])->middleware('auth')->name('user.customersite.list');
Route::get('user/site-tracking/customersite', [CustomerSiteTableController::class,'index'])->middleware('auth')->name('user.customersite');
Route::post('user/site-tracking/customersite/store', [CustomerSiteTableController::class, 'store'])->middleware('auth')->name('user.customersite.store');
Route::post('user/site-tracking/customersite/edit', [CustomerSiteTableController::class, 'edit'])->middleware('auth')->name('user.customersite.edit');
Route::post('user/site-tracking/customersite/destroy', [CustomerSiteTableController::class, 'destroy'])->middleware('auth')->name('user.customersite.destroy');
Route::post('user/site-tracking/customersite/delete-selected', [CustomerSiteTableController::class, 'deleteSelected'])->middleware('auth')->name('user.customersite.delete-selected');

Route::get('user/site-tracking/vendor/list', [VendorController::class,'VendorList'])->middleware('auth')->name('user.vendor.list');
Route::get('user/site-tracking/vendor', [VendorController::class,'index'])->middleware('auth')->name('user.vendor');
Route::post('user/site-tracking/vendor/store', [VendorController::class, 'store'])->middleware('auth')->name('user.vendor.store');
Route::post('user/site-tracking/vendor/edit', [VendorController::class, 'edit'])->middleware('auth')->name('user.vendor.edit');
Route::post('user/site-tracking/vendor/destroy', [VendorController::class, 'destroy'])->middleware('auth')->name('user.vendor.destroy');
Route::post('user/site-tracking/vendor/delete-selected', [VendorController::class, 'deleteSelected'])->middleware('auth')->name('user.vendor.delete-selected');

Route::get('/', [UserLoginController::class,'index'])->name('user.login');
Route::post('user/post-login', [UserLoginController::class, 'postLogin'])->name('user.login.post');
Route::get('user/logout', [UserLoginController::class,'logout'])->name('user.logout');

Route::get('user/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');

Route::get('user/profile', [UserProfileController::class,'index'])->middleware('auth')->name('user.profile');
Route::post('user/profile/update', [UserProfileController::class,'update'])->middleware('auth')->name('user.profile.update');

Route::get('user/profile', [UserProfileController::class,'index'])->middleware('auth')->name('user.profile');
Route::post('user/profile/update', [UserProfileController::class,'update'])->middleware('auth')->name('user.profile.update');

Route::post('user/profile-picture/update', [UserProfileController::class,'updateprofilepicture'])->middleware('auth')->name('user.profilepicture.update');
Route::post('user/profile-picture/delete', [UserProfileController::class, 'deleteprofilepicture'])->middleware('auth')->name('user.profilepicture.delete');

Route::get('user/password', [UserProfileController::class,'changepassword'])->middleware('auth')->name('user.password');
Route::post('user/password/update', [UserProfileController::class,'updatepassword'])->middleware('auth')->name('user.password.update');


/********** ADMIN **********/
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
Route::post('admin/manage/users/edit', [UserManageTableController::class, 'edit'])->middleware('admin')->name('admin.manage.users.edit');
Route::post('admin/manage/users/destroy', [UserManageTableController::class, 'destroy'])->middleware('admin')->name('admin.manage.users.destroy');
Route::post('admin/manage/users//delete-selected', [UserManageTableController::class, 'deleteSelected'])->middleware('admin')->name('admin.manage.users.delete-selected');
