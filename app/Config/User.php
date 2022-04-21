<?php
declare(strict_types=1);

return [
    'entity' => [
        'traits' => 1,
        'request' => [
            'data',
            'condition',
            'search',
            'list_search',
            'create',
            'modify',
            'remove',
            'detail',
            'list',
        ],
        'response' => [
            'list',
            'item',
            'detail',
        ],
    ],
    'controller' => 1,
];