<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserManageTableController extends Controller
{
    public function UserList(Request $request)
    {
        $authenticatedUserId = Auth::id();

        $users = User::where('users.id', '!=', $authenticatedUserId)
                    ->join('roles', 'users.role_id', '=', 'roles.role_id')
                    ->select('users.id', 'users.profile', 'users.name', 'users.email', 'roles.role_name as role_name', 'users.created_at');

        return DataTables::of($users)
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d-m-Y H:i');
                })
                ->addColumn('action', function ($user) {
                    $btn = '<a onClick="editUserFunc('.$user->id.')" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete"><i class="fa-solid fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->input('search')['value'])) {
                        $searchValue = $request->input('search')['value'];
                        $query->where(function ($query) use ($searchValue) {
                            $query->where('users.name', 'like', '%' . $searchValue . '%')
                                  ->orWhere('users.email', 'like', '%' . $searchValue . '%')
                                  ->orWhere('roles.role_name', 'like', '%' . $searchValue . '%');
                        });
                    }
                })
                ->make(true);
    }
    public function index(Request $request)
    {
        $roles = Role::all()->toArray();
        return view('Admin.ManageUser.index', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $userId = $request->id;
        // dd($userId);
        // Validation rules
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required|unique:users,email' . ($userId ? ",$userId" : ''),
            'home_phone' => 'required',
            'address' => 'required',
        ];
        // Skip password validation if not provided
        if (!$request->password) {
            unset($rules['password']);
        }
        $request->validate($rules);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => $request->password,
            'home_phone' => $request->home_phone,
            'cell_phone' => $request->cell_phone,
            'address' => $request->address,
        ];

        if (isset($userData['first_name']) && isset($userData['last_name'])) {
            $userData['name'] = trim($userData['first_name'] . ' ' . $userData['last_name']);
        }

        if (!$request->password) {
            User::updateOrCreate(['id' => $userId], $userData);
        } else {
            User::updateOrCreate(['id' => $userId], array_merge($userData, ['password' => Hash::make($request->password)]));
        }

        return redirect()->route('admin.manage.users');
    }
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $user  = User::where($where)->first();

        return Response()->json($user);
    }
}
