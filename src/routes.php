<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('acl', function() {
        return response()->view(env('ACL_ERROR_PAGE','ACL::unauthorized'))
                ->setStatusCode(env('ACL_ERROR_CODE',403));
    });

    if (App::environment('local')) {
        Route::get('/acl/dashboard', function() {
            return view('ACL::dashboard');
        });

        Route::get('/acl/excludeRouteList', 'Nagarjun\ACL\Controllers\PermissionController@excludeRouteList');
        Route::post('/acl/excludeRouteList', 'Nagarjun\ACL\Controllers\PermissionController@saveExcludeRoute');

        Route::get('/acl/permissionList', 'Nagarjun\ACL\Controllers\PermissionController@permissionList');
        Route::post('/acl/permissionList', 'Nagarjun\ACL\Controllers\PermissionController@savePermission');

        Route::get('/acl/roleList', 'Nagarjun\ACL\Controllers\PermissionController@rolesList');
        Route::post('/acl/roleList', 'Nagarjun\ACL\Controllers\PermissionController@saveRole');
    }
});
