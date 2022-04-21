<?php
declare(strict_types=1);

use LinkCloud\Fast\Hyperf\Framework\BaseModel;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

function generateMysqlConfig(string $path, array $containTables, array $tableMapping = []): array
{
    return [
        'driver'    => env('DB_DRIVER', 'mysql'),
        'read'      => [
            'host' => env('DB_READ_HOST', '127.0.0.1'),
        ],
        'write'     => [
            'host' => env('DB_WRITE_HOST', '127.0.0.1'),
        ],
        'database'  => env('DB_DATABASE', 'hyperf'),
        'port'      => env('DB_PORT', 3306),
        'username'  => env('DB_USERNAME', 'root'),
        'password'  => env('DB_PASSWORD', ''),
        'charset'   => env('DB_CHARSET', 'utf8mb4'),
        'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
        'prefix'    => env('DB_PREFIX', 't_'),
        'pool'      => [
            'min_connections' => 1,
            'max_connections' => 50,
            'connect_timeout' => 10.0,
            'wait_timeout'    => 3.0,
            'heartbeat'       => -1,
            'max_idle_time'   => (float)env('DB_MAX_IDLE_TIME', 60),
        ],
        'commands'  => [
            'gen:model' => [
                'path'             => $path,
                'force_casts'      => true,
                'inheritance'      => 'BaseModel',
                'uses'             => BaseModel::class,
                'refresh_fillable' => true,
                'with_comments'    => true,
                'table_mapping'    => $tableMapping,
                'contain_tables'   => $containTables,
            ],
        ],
    ];
}

return [
    'default' => generateMysqlConfig('app/Model', [
        't_user', // 如果需要生成所有表的内容，此处留空数组
    ]),
];
