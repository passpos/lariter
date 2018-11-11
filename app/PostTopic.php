<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model {

    // 指明表名
    protected $table = 'post_topic';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = ['post_id', 'topic_id'];

}
