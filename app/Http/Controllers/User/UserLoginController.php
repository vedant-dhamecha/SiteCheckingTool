<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class UserLoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('User.Login.userLogin');
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.login')
                             ->withErrors($validator)
                             ->withInput();
        }

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $roleName = optional($user->role)->role_name;

            // Check if the authenticated user is not an admin
            if ($roleName !== 'admin') {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout(); // Log out the user if they are an admin
                return redirect()->route('user.login')->with('error', 'Unauthorized access');
            }
        }

        return redirect()->route('user.login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('user.login');
    }
}
