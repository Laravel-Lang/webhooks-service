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
            'limit' => 20,
        ],

        'max_errors' => 10,
    ],

    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN'),
    ],

    'boosty' => [
        'token' => env('BOOSTY_TOKEN'),
        'blog'  => env('BOOSTY_BLOG'),
    ],
];
