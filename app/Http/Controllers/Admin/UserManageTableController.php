<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserManageTableController extends Controller
{
    public function UserList()
{
    $authenticatedUserId = Auth::id();

    return datatables()->of(User::where('users.id', '!=', $authenticatedUserId)
                            ->join('roles', 'users.role_id', '=', 'roles.role_id')
                            ->select('users.id', 'users.profile', 'users.name', 'users.email', 'roles.role_name', 'users.created_at'))
        ->editColumn('created_at', function ($user) {
            return $user->created_at->format('d-m-Y H:i');
        })
        ->addColumn('action', function ($row) {
            $btn = '<a href="javascript:void(0)" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>';
            $btn .= ' <a href="javascript:void(0)" class="delete"><i class="fa-solid fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
}

    public function index(Request $request)
    {
        return view('Admin.ManageUser.index');
    }
}
