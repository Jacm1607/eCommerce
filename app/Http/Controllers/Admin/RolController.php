<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index(){
        if (auth()->user()->can('rol.index')) {
            return view('admin.roles.index');
        } else {
            abort(403);
        }

    }

    public function edit(Role $rol)
    {
        if (auth()->user()->can('rol.edit')) {
            $privileges = Permission::orderBy('name', 'asc')->get();
            return view('admin.roles.edit', compact('rol','privileges'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, Role $rol)
    {
        if (auth()->user()->can('rol.update')) {
            $rol->update(['name' => $request->name]);
            $rol->syncPermissions($request->privileges);
            return redirect()->route('admin.roles.index');
        } else {
            abort(403);
        }
    }
}
