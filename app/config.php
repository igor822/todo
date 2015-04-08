<?php

return [
    'storage' => [
        'path' => \Task\Constants\PathPattern::HOME . '/Dropbox',
        'driver' => 'file',
        'filename' => 'tasks.json'
    ]
];
