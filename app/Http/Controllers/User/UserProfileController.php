<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

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
    public function changepassword(){
        return view('User.Profile.UserPassword');
    }
    public function updatepassword(Request $request){
        $admin = Auth::user();
        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if (Hash::check($request->current_password, $admin->password)) {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            return redirect()->route('user.password');

        } else {
            return redirect()->back()->with('message', 'Old Password does not match with entered password');
        }
    }
    public function deleteprofile(Request $request)
    {
        $admin = Auth::user();

        $profilePath = public_path('storage/' . $admin->profile);
        if ($admin->profile) {
            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }
        $admin->profile = null;
        $admin->save();

        return redirect()->route('user.profile');
    }
}
