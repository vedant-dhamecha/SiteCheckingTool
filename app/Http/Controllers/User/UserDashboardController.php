<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserDashboardController extends Controller
{
    public function index(){
        return view('User.Dashboard.Dashboard');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('user.login');
    }
}
