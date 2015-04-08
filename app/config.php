<?php

return [
    'storage' => [
        'path' => \Task\Constants\PathPattern::HOME . '/Dropboxsss',
        'path_alternatives' => [
            \Task\Constants\PathPattern::HOME . '/Documents'
        ],
        'driver' => 'file',
        'filename' => 'tasks.json'
    ]
];
