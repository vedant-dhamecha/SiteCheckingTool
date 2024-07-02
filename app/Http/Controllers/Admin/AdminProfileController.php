<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminProfileController extends Controller
{
    public function index(){
        return view('Admin.Profile.AdminProfile');
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
        return redirect()->route('admin.profile');
    }

    public function updateprofilepicture(Request $request)
    {
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = public_path() . "/storage/profiles/" . $image_name;
        file_put_contents($path, $data);

        $admin = Auth::user();
        $profilePath = public_path('storage/' . $admin->profile);
        if ($admin->profile) {
            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }
        $admin->profile = "profiles/" . $image_name;
        $admin->save();
    }
    public function deleteprofilepicture(Request $request)
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

        return redirect()->route('admin.profile');
    }


    public function changepassword(){
        return view('Admin.Profile.AdminPassword');
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
            return redirect()->route('admin.password');

        } else {
            return redirect()->back()->with('message', 'Old Password does not match with entered password');
        }
    }
}
