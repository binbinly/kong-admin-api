<?php

return [
    'option' => [
        'base_uri' => 'http://192.168.1.200:8001',
        'timeout' => 5
    ],
    'cert' => [
        [
            'crt' => file_get_contents('./cert/server.crt'),
            'key' => file_get_contents('./cert/server.key'),
            'tags' => ['all']
        ]
    ]
];