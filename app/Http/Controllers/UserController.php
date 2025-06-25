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
            'title' => 'Akun Administrator',
            'users' => User::all()
        ];
        return view('admin.users.index', $data);
    }
    public function getUsersDataTable()
    {
        $users = User::where('role', 'Admin')->orderByDesc('id');

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
                $verified = '<button class="btn btn-sm btn-warning mx-2" onclick="verification(' . $user->id . ')">Verification</button>';
                return ($user->operator_verified ? ' ' :  $verified) . '<button class="btn btn-sm btn-primary" onclick="resetPassword(' . $user->id . ')">Reset Password</button><button class="btn btn-sm btn-danger mx-2" onclick="deleteOperator(' . $user->id . ')"><i class="bx bx-trash"></i></button>';
            })
            ->addColumn('sk', function ($user) {
                return $user->sk_operator ? '<a href="' . url($user->sk_operator) . '" target="_blank" class="btn btn-sm btn-primary">SK</a>' : '-';
            })
            ->addColumn('ktp', function ($user) {
                return $user->ktp_operator ? '<a href="' . url($user->ktp_operator) . '" target="_blank" class="btn btn-sm btn-primary">KTP</a>' : '-';
            })
            ->addColumn('foto', function ($user) {
                return $user->foto_operator ? '<a href="' . url($user->foto_operator) . '" target="_blank" class="btn btn-sm btn-primary">Foto</a>' : '-';
            })
            ->rawColumns(['action', 'sk', 'ktp', 'foto'])
            ->make(true);
    }
    public function store(Request $request)
    {
        if ($request->filled('id')) {
            $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'id_kabupaten' => ['nullable', 'integer', 'max:255', 'exists:kabupaten,id'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'id_kabupaten' => ['required', 'integer', 'max:255', 'exists:kabupaten,id'],
            ]);
        }


        if ($request->filled('id')) {
            $user = User::find($request->input('id'));
            $usersData = [
                'name' => $request->input('name', $user->name),
                'email' => $request->input('email', $user->email),
                'id_kabupaten' => $request->input('id_kabupaten', $user->id_kabupaten),
                'role' => $request->input('role'),
            ];
            $user = User::find($request->input('id'));
            if (!$user) {
                return response()->json(['message' => 'user not found'], 404);
            }
            // Upload file jika ada
            if ($request->hasFile('sk_operator')) {
                $file = $request->file('sk_operator');
                $filename = 'sk_operator_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/operator', $filename, 'public');
                $usersData['sk_operator'] = 'storage/' . $path;
            }

            if ($request->hasFile('ktp_operator')) {
                $file = $request->file('ktp_operator');
                $filename = 'ktp_operator_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/operator', $filename, 'public');
                $usersData['ktp_operator'] = 'storage/' . $path;
            }

            if ($request->hasFile('foto_operator')) {
                $file = $request->file('foto_operator');
                $filename = 'foto_operator_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/operator', $filename, 'public');
                $usersData['foto_operator'] = 'storage/' . $path;
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
    public function verification($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $User->operator_verified = true;
        $User->save();

        return response()->json($User);
    }
    public function resetPassword($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $User->password = Hash::make('operatorkoni');
        $User->save();

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
