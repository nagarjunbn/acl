<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Middlewares;

/**
 * Description of UserPermissionMiddleware
 *
 * @author nagarjun
 */
use Auth;
use Nagarjun\ACL\Models\Permission;
use Nagarjun\ACL\Models\ExcludedRoute;
use Nagarjun\ACL\Models\ExtraPermission;
use Nagarjun\ACL\Models\RevokedPermission;
use Closure;
use Route;

class UserPermissionMiddleware {

    public function handle($request, Closure $next) {
        $excluded = ExcludedRoute::where('action', Route::current()->uri())
                ->where('method', implode(',', Route::current()->methods()))
                ->count();
        if($excluded > 0) {
            return $next($request);
        } else if (isset(Auth::user()->Role->id)) {
            $permission = Permission::where('role_id', Auth::user()->Role->id)
                    ->where('action', Route::current()->uri())
                    ->where('method', implode(',', Route::current()->methods()))
                    ->count();
            $extra = ExtraPermission::where('user_id', Auth::user()->id)
                    ->where('action', Route::current()->uri())
                    ->where('method', implode(',', Route::current()->methods()))
                    ->count();
            $revoked = RevokedPermission::where('user_id', Auth::user()->id)
                    ->where('action', Route::current()->uri())
                    ->where('method', implode(',', Route::current()->methods()))
                    ->count();
            if (($permission > 0 || $extra > 0) && $revoked <= 0) {
                return $next($request);
            } else {
                return redirect()->intended('/acl')
                                ->with('status', "Sorry..! You Don't have permission to access this page")
                                ->with('alert', 'warning');
            }
        } else {
            return redirect()->intended('/acl')
                            ->with('status', "Sorry..! You Don't have permission to access this page")
                            ->with('alert', 'warning');
        }
    }

}
