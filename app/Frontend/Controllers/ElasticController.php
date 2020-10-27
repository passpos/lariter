<?php

namespace App\Frontend\Controllers;

use App\Mariadb\Frontend\Post;
use App\Mariadb\Frontend\Comment;
use App\Mariadb\Frontend\Up;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ElasticController extends Controller {

    /**
     * 1. 创建template
     * template模版，指对某个类型的字段使用的搜索模式的配置细节。
     * 这里指用户搜索关键字后，Elasticsearch的应对策略，该细节由Scout告知ES；
     * 
     * - 通过向es引擎发送（rest风格的）http请求，创建template；
     * - 要（从服务端）发送http请求，就需要guzzlehttp库；
     */
    public function init() {
        $title = '初始化Elastacsearch模版配置';
        $client = new Client();

        /**
         * 获取ES的配置信息
         * 
         * - 我们在Scout中配置了Elasticsearch的网络参数；
         * - 该配置（scout.php）是一个数组，通过数组节点进行访问；
         * - 其中的 hosts 允许配置多个host，这里只有一个，通过数组索引[0]访问；
         * - 
         */
        $url1 = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
        // $client->delete($url1);

        /**
         * 模版参数
         * 
         * - template 该模版的作用范围（索引范围）；
         * - mappings 映射
         *      - _default_ 默认设置
         * 
         * 注意：下面的是json格式数据，用于发送到Elasticsearch；
         */
        $param1 = [
            'json' => [
                'template' => config('scout.elasticsearch.index'),
                'mappings' => [
                    '_default_' => [
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping'            => [
                                        'type'     => 'text',
                                        'analyzer' => 'ik_smart',
                                        'fields'   => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            $resp = $client->put($url1, $param1);
        } catch (Exception $ex) {
            var_dump($ex->getResponse()->getBody()->getContents());
        }
        $body = $resp->getBody()->getContents();

        return view('frontend.elastic.base', [
            'title' => $title,
            'body'  => $body,
        ]);
    }

    /**
     * 2. 创建index
     * 
     * index/索引，一般对一张数据表建立一个索引
     */
    public function index() {
        $title = '初始化Elastacsearch索引配置';
        $client = new Client();

        $url2 = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        // $client->delete($url2);
        $param2 = [
            'json' => [
                'settings' => [
                    'refresh_interval'   => '5s',
                    'number_of_shards'   => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        "_all" => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ];

        $resp = $client->put($url2, $param2);
        $body = $resp->getBody();

        return view('frontend.elastic.base', [
            'title' => $title,
            'body'  => $body,
        ]);
    }

}
