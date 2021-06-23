<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission, $num_pagination = 10;

    public function __construct(Role $role,  Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    public function permissions ($idPerfil)
    {
        $role = $this->role->find($idPerfil);
        if (!$role)return redirect()->back();

        $permissions = $role->permissions()->paginate($this->num_pagination);

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }

    public function roles ($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission))return redirect()->back();

        $roles = $permission->roles()->paginate($this->num_pagination);

        return view('admin.pages.permissions.roles.roles', compact('permission', 'roles'));
    }

    public function permissionsAvailable(Request $request, $idPerfil)
    {
        if (!$role = $this->role->find($idPerfil)) return redirect()->back();

        $filters = $request->except('_token');

        //$permissions = $this->permission->paginate($this->num_pagination);
        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions','filters'));

    }

    public function attachPermissionsRole(Request $request, $idPerfil)
    {
        if (!$role = $this->role->find($idPerfil)) return redirect()->back();
        //dd($request->permissions);

        if (!$request->permissions || count($request->permissions) == 0){
            return redirect()
                    ->back()
                    ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions', $role->id);

    }

    public function detachPermissionRole($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission)return redirect()->back();

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id);
    }

}