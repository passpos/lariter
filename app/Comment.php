<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

// 评论所属的文章模型关联
    public function post() {
        return $this->belongsTo('App\Post');
    }

}
