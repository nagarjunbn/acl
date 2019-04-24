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
use Nagarjun\ACL\Models\ExcludedRoute;
use App\Http\Controllers\Controller;

/**
 * Description of PermissionController
 *
 * @author nagarjun
 */
class PermissionController extends Controller {

    public function __construct() {
//        $this->middleware(array('acl'));
    }

    public function excludeRouteList() {
        $i = 0;
        $excludedRoutes = ExcludedRoute::all();
        foreach (Route::getRoutes() as $route) {
            $routes[$i++] = [
                'path' => $route->uri(),
                'method' => implode(',', $route->methods())
            ];
        }
        return view('ACL::exclude_index', ['routes' => $routes, 'excludedRoutes' => $excludedRoutes]);
    }

    public function saveExcludeRoute(Request $request) {
        $data = $request->all();
        ExcludedRoute::truncate();
        if (isset($data['routes'])) {
            foreach ($data['routes'] as $action => $methods) {
                foreach ($methods as $method) {
                    ExcludedRoute::create([
                        'action' => $action,
                        'method' => $method
                    ]);
                }
            }
        }
        return redirect()->intended('/home')
                        ->with('status', 'Excluded routes updated successfully')
                        ->with('alert', 'success');
    }

    public function permissionList() {
        $roles = Role::all();
        $permissions = Permission::all();
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
        return view('ACL::index', ['routes' => $routes, 'roles' => $roles,
            'permissions' => $permissions]);
    }

    public function savePermission(Request $request) {
        $data = $request->all();
        Permission::truncate();
        if (isset($data['permission'])) {
            foreach ($data['permission'] as $roleID => $actions) {
                foreach ($actions as $action => $methods) {
                    foreach ($methods as $method) {
                        Permission::create([
                            'role_id' => $roleID,
                            'action' => $action,
                            'method' => $method
                        ]);
                    }
                }
            }
        }
        return redirect()->intended('/home')
                        ->with('status', 'Permissions update successfully')
                        ->with('alert', 'success');
    }

    public function rolesList() {
        $roles = Role::all();
        return view('ACL::role_index', ['roles' => $roles]);
    }

    public function saveRole(Request $request) {
        Role::create([
            'name' => $request->name,
            'acl_enabled' => 'yes'
        ]);
        return redirect()->intended('/home')
                        ->with('status', 'Role added successfully')
                        ->with('alert', 'success');
    }

}
