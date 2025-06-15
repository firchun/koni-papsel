<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => User::all()
        ];
        return view('admin.users.index', $data);
    }
    public function getUsersDataTable()
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at', 'role', 'avatar'])->orderByDesc('id');

        return Datatables::of($users)
            ->addColumn('avatar', function ($user) {
                return view('admin.users.components.avatar', compact('user'));
            })
            ->addColumn('action', function ($user) {
                return view('admin.users.components.actions', compact('user'));
            })
            ->addColumn('role', function ($user) {
                return '<span class="badge bg-label-primary">' . $user->role . '</span>';
            })

            ->rawColumns(['action', 'role', 'avatar'])
            ->make(true);
    }
    public function getByKabupaten($id)
    {
        $users = User::where('id_kabupaten', $id);

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-sm btn-primary" onclick="resetPassword(' . $user->id . ')">Reset Password</button><button class="btn btn-sm btn-danger mx-2" onclick="deleteOperator(' . $user->id . ')"><i class="bx bx-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        if ($request->filled('id')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'id_kabupaten' => ['required', 'integer', 'max:255', 'exists:kabupaten,id'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'id_kabupaten' => ['required', 'integer', 'max:255', 'exists:kabupaten,id'],
            ]);
        }


        if ($request->filled('id')) {
            $usersData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'id_kabupaten' => $request->input('id_kabupaten'),
                'role' => $request->input('role'),
            ];
            $user = User::find($request->input('id'));
            if (!$user) {
                return response()->json(['message' => 'user not found'], 404);
            }

            $user->update($usersData);
            $message = 'user updated successfully';
        } else {
            $usersData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'id_kabupaten' => $request->input('id_kabupaten'),
                'role' => $request->input('role') ?? 'Operator',
                'password' => $request->input('password') ?? Hash::make('operatorkoni'),
            ];

            User::create($usersData);
            $message = 'user created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function edit($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($User);
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}