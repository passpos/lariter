<?php

namespace App\Mariadb\Backend;

use Illuminate\Database\Eloquent\Model;

// 对应表“posts”
class Post extends Model {

    // 指明表名
    protected $table = 'posts';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    // 开启自动维护时间戳
    public $timestamps = true;
    
    public function user() {
        /**
         * belongsTo()的参数：
         * 第一个参数指明了当前模型要关联的模型；
         * 第二个参数是当前Posts表中要关联的具体的外键字段名；
         * 第三个参数是Users表中被关联的具体的主键字段名。
         * 
         * 当第2、3个参数的格式遵循下面形式时，就可以省略掉后两个参数；
         * 当然可以不遵循下面的形式，只需要像下面一样指明具体的字段名称；
         * 
         * 关联结果：
         * 通过访问这里的Post的user()函数；
         * 就可以访问与Post中的user_id相对应的User中的对应id的那一条数据；
         *   访问时：
         *     使用$post->user->name访问具体的‘name’值；
         *     使用$post->user()访问一条数据对象（数组）；
         */
        return $this->belongsTo('App\Mariadb\Web\User', 'user_id', 'id');
    }

}
