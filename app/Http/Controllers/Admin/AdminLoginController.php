<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class AdminLoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Admin.Login.adminLogin');
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.login')
                             ->withErrors($validator)
                             ->withInput();
        }

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Retrieve the authenticated user instance
            $user = auth()->user();

            // Check if the authenticated user has the role of 'admin'
            if ($user->role->role_name === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout(); // Log out the user if they don't have admin role
                return redirect()->route('admin.login')->with('error', 'Unauthorized access');
            }
        }

        return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
