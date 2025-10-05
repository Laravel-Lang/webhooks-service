<?php

declare(strict_types=1);

return [
    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN'),
    ],

    'boosty' => [
        'token' => env('BOOSTY_TOKEN'),
        'blog'  => env('BOOSTY_BLOG'),

        'excludes' => [
            '.github',
            'docs',
            'status-generator',
            'webhooks-service',
        ],
    ],
];
