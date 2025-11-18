<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($response = $this->checkIzin('access_user')) {
            return $response;
        }

        if ($request->ajax()) {
            $data = User::with('role');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->role ? $row->role->name : '-';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success text-white">Active</span>'
                        : '<span class="badge bg-danger text-white">Non-active</span>';
                })
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="btn-group" role="group">';
                    if (Auth()->user()->role->edit_user) {
                        $editUrl = route('users.edit', $row->id);
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>';
                    }
                    if (Auth()->user()->role->delete_user) {
                        $deleteUrl = route('users.destroy', $row->id);
                        $buttons .= '
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Delete this data?\')" style="display:inline-block;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        ';
                    }
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        if ($response = $this->checkIzin('create_user')) {
            return $response;
        }

        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if ($response = $this->checkIzin('create_user')) {
            return $response;
        }

        $request->validate([
            'role_id'      => 'required|exists:roles,id',
            'name'         => 'required|string|max:255',
            'username'        => 'required|string|max:255|unique:users,username',
            'password'     => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'role_id'   => $request->role_id,
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => bcrypt($request->password),
        ]);

        $data = json_encode($request->except(['_token', '_method']));

        ActivityLog::log(Auth()->user()->id, "Create User {$data}.");

        return redirect()->route('users.index')->with('success', 'User has been created.');
    }

    public function edit(User $user)
    {
        if ($response = $this->checkIzin('edit_user')) {
            return $response;
        }

        $roles = Role::pluck('name', 'id');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($response = $this->checkIzin('edit_user')) {
            return $response;
        }

        $request->validate([
            'role_id'       => 'required|exists:roles,id',
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,' . $user->id,
            'password'      => 'nullable|string|min:8|confirmed',
            'is_active'     => 'boolean',
        ]);

        $data = $request->only(['role_id', 'name', 'username', 'is_active']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        $data = json_encode($data);

        ActivityLog::log(Auth()->user()->id, "Edit User {$data}.");

        return redirect()->route('users.index')->with('success', 'User has been updated.');
    }

    public function destroy(User $user)
    {
        if ($response = $this->checkIzin('delete_user')) {
            return $response;
        }

        ActivityLog::log(Auth()->user()->id, "Delete User {$user}.");

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }
}
