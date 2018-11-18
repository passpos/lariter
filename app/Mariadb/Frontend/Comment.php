<?php

namespace App\Mariadb\Frontend;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * 评论所属的文章模型关联
     * 
     * 一个评论只能关联到一篇文章所以用belongsTo()
     */
    public function post() {
        return $this->belongsTo('App\Mariadb\Frontend\Post');
    }
    
    /**
     * 关联评论（当前模型）与评论作者（user模型）
     * 
     * 这里是一个评论被关联到一个作者，所以用belongsTo()
     */
    public function user() {
        return $this->belongsTo('App\Mariadb\Frontend\User');
    }

}
