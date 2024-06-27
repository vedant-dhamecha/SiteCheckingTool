<?php

use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLoginController;
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

Route::get('user/login',[UserLoginController::class,'index'])->name('user.login');
Route::post('user/post-login', [UserLoginController::class, 'postLogin'])->name('user.login.post');
Route::get('user/dashboard',[UserDashboardController::class,'index'])->name('user.dashboard')->middleware('auth');;
