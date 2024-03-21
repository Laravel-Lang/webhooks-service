<?php

return [
    'telegram' => [
        'token' => env('TELEGRAM_BOT_TOKEN'),
        'name'  => env('TELEGRAM_BOT_NAME'),

        'excludes' => [
            '.github',
            'docs',
            'release-publisher',
            'status-generator',
        ],
    ],

    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN'),
    ],
];
