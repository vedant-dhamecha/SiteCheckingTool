<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        return view('User.Profile.UserProfile');
    }
    public function update(Request $request){
        $admin = Auth::user();

        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        // $admin->email = $request->input('email');
        $admin->cell_phone = $request->input('cell_phone');
        $admin->home_phone = $request->input('home_phone');
        $admin->address = $request->input('address');
        $admin->save();
        return redirect()->route('user.profile');
    }
}
