<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

    // 指明表名
    protected $table = 'topics';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    public $timestamps = true;

}
