<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Role
 *
 * @author nagarjun
 */
class Role extends Model {

    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function getRoleByName($name) {
        $role = Role::where('name', $name)->first();
        return $role;
    }

}
