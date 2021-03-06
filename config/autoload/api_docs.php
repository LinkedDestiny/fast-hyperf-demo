<?php

declare(strict_types=1);
return [
    // enable false 将不会启动 swagger 服务
    'enable'           => env('APP_ENV') !== 'prod',
    'output_dir'       => BASE_PATH . '/public',
    'prefix_url'       => env('API_DOCS_PREFIX_URL', '/swagger'),
    //认证api key
    // type ege: header, query, cookie
    'security_api_key' => ['Authorization', 'query' => 'token'],
    //全局responses
    'responses'        => [

    ],
    //替换验证属性
    'validation_custom_attributes' => true,
    // swagger 的基础配置
    'swagger'          => [
        'swagger' => '2.0',
        'host'    => env('API_DOCS_HOST',''),
        'info'    => [
            'description' => 'swagger api desc',
            'version'     => '1.0.0',
            'title'       => 'API DOC',
        ],
    ],
];
