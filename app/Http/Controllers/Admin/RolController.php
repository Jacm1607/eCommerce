<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index(){
        return view('admin.roles.index');
    }

    public function edit(Role $rol)
    {
        $privileges = Permission::all();
        return view('admin.roles.edit', compact('rol','privileges'));
    }

    public function update(Request $request, Role $rol)
    {
        $rol->update(['name' => $request->name]);
        $rol->syncPermissions($request->privileges);
        return redirect()->route('admin.roles.index');
    }
}
