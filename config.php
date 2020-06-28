<?php

return [
    'option' => [
        'base_uri' => 'http://127.0.0.1:8001',
        'timeout' => 5
    ],
    'cert' => [
        [
            'crt' => file_get_contents('/www/cert/server_admin.crt'),
            'key' => file_get_contents('/www/cert/server_admin.key'),
            'tags' => ['all']
        ]
    ]
];