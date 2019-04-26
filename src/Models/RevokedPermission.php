<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Models;

/**
 * Description of RevokedPermission
 *
 * @author nagarjun
 */
use Illuminate\Database\Eloquent\Model;

class RevokedPermission extends Model {

    protected $fillable = ['id', 'user_id', 'action', 'method', 'created_at', 'updated_at'];

}
