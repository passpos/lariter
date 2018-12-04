<?php

namespace App\Mariadb\Backend;

use App\Mariadb\Model;

class BackendTopic extends Model {

    // 指明表名
    protected $table = 'topics';
    // 默认以ID作为主键
    protected $primaryKey = 'id';

}
