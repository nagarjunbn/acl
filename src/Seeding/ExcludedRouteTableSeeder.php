<?php

namespace Nagarjun\ACL\Seeding;

use Illuminate\Database\Seeder;
use DB;

class ExcludedRouteTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $routes = array(
            [
                'action' => 'acl',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/dashboard',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/excludeRouteList',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/excludeRouteList',
                'method' => 'POST'
            ], [
                'action' => 'acl/permissionList',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/permissionList',
                'method' => 'POST'
            ], [
                'action' => 'acl/roleList',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/roleList',
                'method' => 'POST'
            ], [
                'action' => 'acl/userList',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/userPermissionList/{id}',
                'method' => 'GET,HEAD'
            ], [
                'action' => 'acl/userPermissionList/{id}',
                'method' => 'POST'
            ]
        );
        foreach ($routes as $route) {
            DB::table('excluded_routes')->insert([
                'action' => $route['action'],
                'method' => $route['method'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

}
