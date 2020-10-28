<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model {

    protected $table = 'fans';
    protected $fillable = ['fan_id', 'star_id'];
    public $timestamps = true;

    // 关联用户粉丝
    public function userFan() {
        return $this->hasOne('App\Models\Frontend\User', 'id', 'fan_id');
    }

    // 用户关注（了哪些用户）
    public function userStar() {
        return $this->hasOne('App\Models\Frontend\User', 'id', 'star_id');
    }

}
