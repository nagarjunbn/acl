<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Nagarjun\ACL\Models\Role;
use Nagarjun\ACL\Models\Permission;
use Nagarjun\ACL\Models\ExtraPermission;
use Nagarjun\ACL\Models\RevokedPermission;
use Nagarjun\ACL\Models\ExcludedRoute;
use App\Http\Controllers\Controller;
use App\User;

/**
 * Description of UserPermissionController
 *
 * @author nagarjun
 */
class UserPermissionController extends Controller {

    public function __construct() {
//        $this->middleware(array('acl'));
    }

    public function userList() {
        $users = User::paginate(20);
        return view('ACL::user_index', ['users' => $users]);
    }

    public function userPermissionList($id) {
        $user = User::findOrfail($id);
        $role = Role::findOrfail($user->role_id);
        $permissions = Permission::where('role_id', $role->id)
                ->get();

        $extraPermissions = ExtraPermission::where('user_id', $id)->get();
        $revokedPermissions = RevokedPermission::where('user_id', $id)->get();
        $routes = array();
        $i = 0;
        foreach (Route::getRoutes() as $route) {
            $excluded = ExcludedRoute::where('action', $route->uri())
                    ->where('method', implode(',', $route->methods()))
                    ->count();
            if ($excluded == 0) {
                $routes[$i++] = [
                    'path' => $route->uri(),
                    'method' => implode(',', $route->methods())
                ];
            }
        }
        return view('ACL::user_permission_index', ['user' => $user, 'role' => $role,
            'permissions' => $permissions, 'routes' => $routes, 'extraPermissions' => $extraPermissions,
            'revokedPermissions' => $revokedPermissions ]);
    }

    public function saveUserPermission(Request $request, $id) {
        $data = $request->all();
        ExtraPermission::where('user_id', $id)->delete();
        RevokedPermission::where('user_id', $id)->delete();
        if (isset($data['extra_permission'])) {
            foreach ($data['extra_permission'] as $action => $methods) {
                foreach ($methods as $method) {
                    ExtraPermission::create([
                        'user_id' => $id,
                        'action' => $action,
                        'method' => $method
                    ]);
                }
            }
        }
        if (isset($data['revoke_permission'])) {
            foreach ($data['revoke_permission'] as $action => $methods) {
                foreach ($methods as $method) {
                    RevokedPermission::create([
                        'user_id' => $id,
                        'action' => $action,
                        'method' => $method
                    ]);
                }
            }
        }
        return redirect()->intended('/acl/dashboard')
                        ->with('status', 'Permissions updated successfully')
                        ->with('alert', 'success');
    }

}
