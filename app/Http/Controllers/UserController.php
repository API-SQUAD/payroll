<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $roles = Role::all();
        return view('users.index', compact('roles'));
    }

    public function data(Request $request) : JsonResponse
    {
        $users = User::with('roles')->get();
        if ($request->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('nik_nama', function ($row) {
                    return $row->nik . ' / ' . $row->fullname;
                })
                ->addColumn('role', function ($row) {
                    return $row->roles->pluck('name')->implode(', '); // if you want to display all roles as a comma-separated string
                })
                ->addColumn('action', function ($row) {
                    $route_update = route('users.update', encrypt($row['id']));
                    $route_delete = route('users.destroy', encrypt($row['id']));
                    $btn = '';

                    $btn .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm btn-icon mr-1" id="ubah" title="Edit" data-toggle="tooltip" data-placement="top" data-url="' . $route_update . '"><i class="fa fa-edit"></i></a>';

                    if (Auth::user()->id !== $row->id) {
                        $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-icon" id="hapus" title="Delete" data-toggle="tooltip" data-placement="top" data-url="' . $route_delete . '"><i class="fa fa-trash"></i></a> ';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'nik' => $request->nik,
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $role = Role::find($request->role_id);
            $user->assignRole($role->name);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'toast' => 'New user added successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json([
                'status' => 'error',
                'toast' => 'Failed save data' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail(decrypt($id));

            $user->nik = $request->nik;
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
            }

            $user->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'toast' => 'User updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'toast' => 'Failed to update data: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find(decrypt($id));
            $user->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'toast' => 'User deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'toast' => 'Error server' . $e->getMessage(),
            ]);
        }
    }
}
