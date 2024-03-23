<?php

return [
    'telegram' => [
        'token' => env('TELEGRAM_BOT_TOKEN'),
        'name'  => env('TELEGRAM_BOT_NAME'),

        'excludes' => [
            '.github',
            'docs',
            'status-generator',
            'webhooks-service',
        ],

        'changelog' => [
            'limit' => 384,
        ],
    ],

    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN'),
    ],
];
