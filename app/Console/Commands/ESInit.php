<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class ESInit extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init laravel for post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        /**
         * 1. 创建template
         * template模版，指对某个类型的字段使用的搜索模式的配置细节。
         * 
         * - 通过向es引擎发送（rest风格的）http请求，创建template；
         * - 要（从服务端）发送http请求，就需要guzzlehttp库；
         */
        $client = new Client();

        /**
         * 获取ES的配置信息
         * 
         * - 我们在Scout中配置了Elasticsearch的网络参数；
         * - 该配置（scout.php）是一个数组，通过数组节点进行访问；
         * - 其中的 hosts 允许配置多个host，这里只有一个，通过数组索引[0]访问；
         * - 
         */
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
        // $client->delete($url);

        /**
         * 模版参数
         */
        $param1 = [
            'json' => [
                // 该模版的作用范围（索引范围）； 
                'template' => config('scout.elasticsearch.index'),
                // 映射
                'mappings' => [
                    // 默认设置
                    '_default_' => [
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'fields' => [
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
        $client->put($url, $param1);
        $this->info("======== 创建模板成功 =======");

        /**
         * 2. 创建index
         * 
         * index/索引，一般对一张数据表建立一个索引
         */
        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        // $client->delete($url);
        $param2 = [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1,
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
        $client->put($url, $param2);
        $this->info("======== 创建索引成功 =======");
    }

}
