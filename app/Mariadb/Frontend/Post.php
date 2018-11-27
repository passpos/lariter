<?php

namespace App\Mariadb\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

// 对应表“posts”
class Post extends Model {

    use Searchable;

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

    // 定义索引中的type
    public function searchableAs() {
        return 'post';
    }

    /**
     * 定义有哪些字段，持久化到搜索索引，即需要可被搜索。
     *   默认是：模型的所有字段都可搜索；
     *   使用toSearchableArray()方法进行重新定义。
     */
    public function toSearchableArray() {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    /**
     * 用户关联（将文章和用户关联起来），用于访问关联的数据。
     * 
     * 这个关联通过在Post模型中定义user模型函数；
     * 以实现通过post，调用user函数访问user表；
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
        return $this->belongsTo('App\Mariadb\Frontend\User', 'user_id', 'id');
    }

    /**
     * 被评论的文章与评论关联
     *   一篇文章有多个评论
     */
    public function comments() {
        return $this->hasMany('App\Mariadb\Frontend\Comment')->orderBy('created_at', 'desc');
    }

    /**
     * 赞和用户进行关联
     *   一篇文章（对于某个确定的用户）只有一个赞；
     *   以user_id作为约束参数；
     */
    public function up($user_id) {
        return $this->hasOne('App\Mariadb\Frontend\Up')->where('user_id', $user_id);
    }

    // 文章获得的所有赞
    public function ups() {
        return $this->hasMany('App\Mariadb\Frontend\Up', 'post_id', 'id');
    }

    /**
     * 文章和专题的模型关联
     *   一篇文章可以被投送发表到多个专题
     */
    public function postTopics() {
        return $this->hasMany('App\Mariadb\Frontend\PostTopic', 'post_id', 'id');
    }

    /**
     * 属于某个作者的文章
     *   使用scope函数进行选择性（条件性）查询；
     *   既然是对模型的查询，当然要用查询构造器（QueryBuilder）；
     * 要查询“某个作者”的“文章”，自然要通过Post模型的“$user_id”字段；
     * 查询的既然是文章，自然要定义在Post模型中。
     */
    public function scopeAuthorBy(Builder $query, $user_id) {
        return $query->where('user_id', $user_id);
    }

    /**
     * 不属于某个专题的文章（此时需要传递该专题的topic_id）
     *   doesntHave()函数，添加一个包含计数/存在性条件的关联模型到查询中；
     *   这个查询是按条件反向查询，即查询不符合条件的结果；
     * 
     *   has()、doesntHave()都是针对：在关联模型中生成的条件约束，然后去查询此处Post的模型。
     * 
     * 查询结果是：
     *   返回所有的非$topic_id专题的Post模型中的问章。
     */
    public function scopeTopicNotBy(Builder $query, $topic_id) {
        // 在被关联的postTopics模型中，按条件（取反）查询
        return $query->doesntHave('postTopics', 'and', function($q) use($topic_id) {
                    // 条件：
                    $q->where('topic_id', $topic_id);
                }
        );
    }

    protected static function boot() {
        parent::boot();
        static::addGlobalScope('available', function(Builder $builder) {
            $builder->whereIn('status', [0, 1]);
        });
    }

}
