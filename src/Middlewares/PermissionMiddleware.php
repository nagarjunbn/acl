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
use Closure;
use Route;

class PermissionMiddleware {

    //put your code here
    public function handle($request, Closure $next) {
        // $authArray = array(
        //     'login','logout','register','password/reset/{token?}',
        //     'password/email','password/reset','home','/'
        // );
        // if(!in_array(Route::current()->uri(),$authArray)) {
        if (isset(Auth::user()->Role->id)) {
            $permission = Permission::where('role_id', Auth::user()->Role->id)
                            ->where('action', Route::current()->uri())->count();
            if ($permission) {
                return $next($request);
            } else {
                return redirect()->intended('/home')
                                ->with('status', "Sorry..! You Don't have permission to access this page")
                                ->with('alert', 'warning');
            }
            // } else {
            //     return $next($request);
        } else {
            return redirect()->intended('/home')
                            ->with('status', "Sorry..! You Don't have permission to access this page")
                            ->with('alert', 'warning');
        }
        // } else {
        //     return $next($request);
        // }
    }

}
