<?php

namespace App\Mariadb\Backend;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BackendUser extends Authenticatable {

    protected $table = 'backend_users';
    protected $rememberTokenName = '';
    protected $fillable = ['name', 'password'];
    protected $primaryKey = 'id';

}
