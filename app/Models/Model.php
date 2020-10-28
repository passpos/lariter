<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * 其他的数据表模型继承的不再是Illuminate\Database\Eloquent\Model，
 * 而是App\Models\Model；
 * 继承时use App\Models\Model；
 * 
 * 为所有的表开启下面的功能：
 */
class Model extends BaseModel{

    protected $connection = 'mysql';
    // 不可以注入的字段
    protected $guarded = [];
    // 开启自动维护时间戳
    public $timestamps = true;

}
