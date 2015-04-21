<?php

return [
    'cache' => [
        'path' => \Task\Constants\PathPattern::HOME . '/.todo',
        'config_file' => 'config.json'
    ],
    'storage' => [
        'driver' => 'file',
        'file-storage' => \Task\Constants\PathPattern::HOME . '/.todo/tasks.todo'
    ]
];
