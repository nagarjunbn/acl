<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Middlewares;

/**
 * Description of PermissionMiddleware
 *
 * @author nagarjun
 */
use Auth;
use Nagarjun\ACL\Models\Permission;
use Nagarjun\ACL\Models\ExcludedRoute;
use Closure;
use Route;

class PermissionMiddleware {

    public function handle($request, Closure $next) {
        if (isset(Auth::user()->Role->id)) {
            $permission = Permission::where('role_id', Auth::user()->Role->id)
                    ->where('action', Route::current()->uri())
                    ->where('method', implode(',', Route::current()->method))
                    ->count();
            $excluded = ExcludedRoute::where('action', Route::current()->uri())
                    ->where('method', implode(',', Route::current()->method))
                    ->count();
            if ($permission > 0 || $excluded > 0) {
                return $next($request);
            } else {
                return redirect()->intended('/home')
                                ->with('status', "Sorry..! You Don't have permission to access this page")
                                ->with('alert', 'warning');
            }
        } else {
            return redirect()->intended('/home')
                            ->with('status', "Sorry..! You Don't have permission to access this page")
                            ->with('alert', 'warning');
        }
    }

}
