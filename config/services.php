<?php

declare(strict_types=1);

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
