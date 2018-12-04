<?php

namespace App\Mariadb\Backend;

use App\Mariadb\Model;

// 对应表“posts”
class BackendPost extends Model {

    // 指明表名
    protected $table = 'posts';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    
    public function user() {
        return $this->belongsTo('App\Mariadb\Backend\FrontendUser', 'user_id', 'id');
    }

}
