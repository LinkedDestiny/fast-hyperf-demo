<?php
declare(strict_types=1);

return [
    'base_path' => BASE_PATH, // 项目基本路径定义
    'transfers' => [  // 翻译生成工具的配置
        'languages' => [ // 支持的语言类型
            'zh_CN',
        ],
        'dirs' => [ // 需要扫描的文件以及输出路径
            BASE_PATH . '/storage/languages/%s/errors.php' => [
                BASE_PATH . '/app/Constants/Errors'
            ],
            BASE_PATH . '/storage/languages/%s/enums.php' => [
                BASE_PATH . '/app/Constants/Status',
                BASE_PATH . '/app/Constants/Types',
                BASE_PATH . '/app/Constants/Enums',
            ],
        ],
    ]
];