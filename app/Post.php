<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 对应表“posts”
class Post extends Model{

    // 指明表名
    protected $table = 'posts';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    //可以注入的字段
    protected $fillable = ['title', 'content'];
    // 开启自动维护时间戳
    public $timestamps = true;

}
