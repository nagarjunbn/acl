<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Constants;

class PackageRoutes {

    public static function all() {
        $routes = array(
            'acl', 'acl/dashboard', 'acl/excludeRouteList', 'acl/permissionList',
            'acl/roleList', 'acl/userList', 'acl/userPermissionList/{id}'
        );
        return $routes;
    }

}
