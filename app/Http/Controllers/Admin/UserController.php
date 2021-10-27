<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function edit(User $user)
    {
        if (auth()->user()->can('user.edit')) {
            $roles = Role::all();
            return view('admin.users.edit', compact('user','roles'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->can('user.update')) {
            $user->syncRoles($request->roles);
            return redirect()->route('admin.users.index');
        } else {
            abort(403);
        }
    }
}
