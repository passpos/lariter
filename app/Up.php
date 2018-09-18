<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Up extends Model
{
    // 指明表名
    protected $table = 'ups';
    protected $fillable = ['user_id','post_id'];
    // 开启自动维护时间戳
    public $timestamps = true;
}
