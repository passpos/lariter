<?php

namespace App;

use App\Fan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 文章与作者关系的模型关联，粉丝关系的模型关联
     * 
     * 用户（id）关联“文章”模型，
     *     一个用户有多个文章，关联Post模型，关联Posts表的'user_id'字段
     * 用户（id）关联“我的粉丝”模型，关注我的粉丝
     *     一个用户有多个粉丝，关联Fan模型，关联Fans表的'star_id'字段
     * 用户（id）关联“我关注的用户”Fan模型
     *     一个用户关注多个用户，关联Fan模型，关联Fans表的'fan_id'字段
     * 
     * 下面的'star_id'，'fan_id'都表示用户'user_id'
     *   $this指当前的User用户模型
     *   'star_id'表示该用户关注的用户的id
     *   'fan_id'表示关注该用户的用户id
     */
    public function posts() {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function fans() {
        return $this->hasMany('App\Fan', 'star_id', 'id');
    }

    public function stars() {
        return $this->hasMany('App\Post', 'fan_id', 'id');
    }

    /**
     * 关注与取消关注行为
     * 
     * 一个关注行为包含了关注行为的发起方（当前用户，并作为一个粉丝），和被关注的对象（作为一个star）
     * 
     * 关注某人
     *     关注时，传入被关注用户的uid，
     *     在Fans表的‘star_id’字段插入被关注用户的uid
     *     在Fans表的‘fan_id’字段插入当前用户的id
     * 
     * 取消关注某人
     *     在Fans表的‘fan_id’字段，查找当前用户id
     *     在Fans表的‘star_id’字段，查找被关注用户的id
     *     删除查找到的记录
     */
    public function doFocus($uid) {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    public function unFocus($uid) {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    /**
     * 对当前用户的关注状态与粉丝关系检查
     * 
     * 是否被某个uid关注
     * 是否关注了某个uid
     */
    public function hasBeenFocus($uid) {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    public function hasFocus($uid) {
        return $this->stars()->where('star_id', $uid)->count();
    }

}
