<?php

namespace App\Mariadb\Frontend;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

    // 指明表名
    protected $table = 'topics';
    // 默认以ID作为主键
    protected $primaryKey = 'id';
    //不可以注入的字段
    protected $guarded = [];
    public $timestamps = true;

    /**
     * 属于该专题的所有文章
     * 
     * @param1  string  $related（被关联模型）
     * @param2  string  $table（多对多关系表）
     * @param3  string  $foreignPivotKey （外键）
     * @param4  string  $relatedPivotKey（被关联键）
     * 
     * 将文章'App\Post'模型关联到数据表'post_topics'模型
     *   App\Post是被关联的模型，被关联到post_topics表；
     *   post_topics是post与topic的多对多关系表；
     */
    public function posts() {
        return $this->belongsToMany('App\Mariadb\Frontend\Post', 'post_topics', 'topic_id', 'post_id');
    }

    /**
     * 专题文章数（一个专题拥有多少文章），用于withCount()；
     * 
     * @param  string  $related
     * @param  string  $foreignKey
     * @param  string  $localKey
     */
    public function topicPosts() {
        return $this->hasMany('App\Mariadb\Frontend\PostTopic', 'topic_id', 'id');
    }

}
