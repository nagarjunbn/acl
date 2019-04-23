<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nagarjun\ACL\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of ExcludedRoute
 *
 * @author nagarjun
 */

class ExcludedRoute extends Model {

    protected $fillable = [
        'id', 'action', 'created_at', 'updated_at'
    ];

}
