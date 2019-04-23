<?php

Route::get('hello', function() {
    echo "hello acl plugin";
});

Route::get('/acl/excludeRouteList', 'Nagarjun\ACL\Controllers\PermissionController@excludeRouteList');
Route::post('/acl/excludeRouteList', 'Nagarjun\ACL\Controllers\PermissionController@saveExcludeRoute');

Route::get('/acl/permissionList', 'Nagarjun\ACL\Controllers\PermissionController@permissionList');
Route::post('/acl/permissionList', 'Nagarjun\ACL\Controllers\PermissionController@savePermission');

Route::get('/acl/roleList', 'Nagarjun\ACL\Controllers\PermissionController@rolesList');
Route::post('/acl/roleList', 'Nagarjun\ACL\Controllers\PermissionController@saveRole');