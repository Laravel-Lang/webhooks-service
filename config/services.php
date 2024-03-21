<?php

return [
    'telegram' => [
        'token' => env('TELEGRAM_BOT_TOKEN'),
        'name' => env('TELEGRAM_BOT_NAME'),

        'excludes' => [
            '.github',
            'release-publisher',
        ]
    ],

    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN'),
    ],
];
