<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 对应表“posts”
class Post extends Model {

    // 指明表名
    protected $table = 'posts';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    //可以注入的字段
    protected $fillable = ['title', 'content', 'user_id'];
    // 开启自动维护时间戳
    public $timestamps = true;

    /**
     * 用户关联（将文章和用户关联起来），用于访问关联的数据。
     * 
     * 这个关联通过在Post模型中定义user模型函数；
     * 以实现通过post条用user函数访问user表；
     * 
     * belongsTo()函数使user()函数即user表被归属关联到post表；
     * hasMany()函数是comment()函数
     */
    public function user() {
        /**
         * belongsTo()的参数：
         * 第一个参数指明了当前模型要关联的模型；
         * 第二个参数是当前Posts表中要关联的具体的外键字段名；
         * 第三个参数是Users表中被关联的具体的主键字段名。
         * 
         * 当第2、3个参数的格式遵循下面形式时，就可以省略掉后两个参数；
         * 当然可以不遵循下面的形式，只需要像下面一样之名具体的字段名称；
         * 
         * 关联结果：
         * 通过访问这里的Post的user()函数；
         * 就可以访问与Post中的user_id相对应的User中的对应id的那一条数据；
         *   访问时：
         *     使用$post->user->name访问具体的‘name’值；
         *     使用$post->user()访问一条数据对象（数组）；
         */
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * 评论关联
     */
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    /**
     * 赞和用户进行关联
     * 
     * 以user_id作为约束参数
     */
    public function up($user_id) {
        return $this->hasOne('App\Up')->where('user_id', $user_id);
    }
    // 所有赞
    public function ups() {
        return $this->hasMany('App\Up');
    }

}
