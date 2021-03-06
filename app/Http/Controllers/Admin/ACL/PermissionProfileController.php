<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission, $num_pagination = 10;

    public function __construct(Profile $profile,  Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions ($idPerfil)
    {
        $profile = $this->profile->find($idPerfil);
        if (!$profile)return redirect()->back();

        $permissions = $profile->permissions()->paginate($this->num_pagination);

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function profiles ($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission))return redirect()->back();

        $profiles = $permission->profiles()->paginate($this->num_pagination);

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }

    public function permissionsAvailable(Request $request, $idPerfil)
    {
        if (!$profile = $this->profile->find($idPerfil)) return redirect()->back();

        $filters = $request->except('_token');

        //$permissions = $this->permission->paginate($this->num_pagination);
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions','filters'));

    }

    public function attachPermissionsProfile(Request $request, $idPerfil)
    {
        if (!$profile = $this->profile->find($idPerfil)) return redirect()->back();
        //dd($request->permissions);

        if (!$request->permissions || count($request->permissions) == 0){
            return redirect()
                    ->back()
                    ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);

    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission)return redirect()->back();

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }

}