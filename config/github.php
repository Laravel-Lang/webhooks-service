<?php

declare(strict_types=1);

/*
 * This file is part of Laravel GitHub.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'default' => 'main',

    'connections' => [
        'main' => [
            'method' => 'token',
            'token'  => env('GITHUB_TOKEN'),
            'secret' => env('GITHUB_SECRET'),
        ],
    ],

    'cache' => [
        'main' => [
            'driver'    => 'illuminate',
            'connector' => null,
        ],
    ],

    'dependabot' => [
        'id' => 49699333,

        // Delay in seconds
        'delay' => 5 * 60,
    ],

    'labels' => [
        'create' => [
            'added'          => ['0e8a16', 'Change that adds something'],
            'bug'            => ['d93f0b', 'Fixing project bugs'],
            'dependencies'   => ['0366d6', 'Updating dependencies'],
            'feature'        => ['a2eeef', 'New feature or request'],
            'fix'            => ['d4c5f9', 'Functionality or something fix'],
            'machine'        => ['fef2c0', 'Machine translation of text'],
            'major'          => ['1d76db', 'Breaking changes'],
            'minor'          => ['a0600b', 'Non-critical changes to the project structure'],
            'removed'        => ['fbca04', 'Removed functionality or content'],
            'security'       => ['d1260f', 'Security violation detected'],
            'skip-changelog' => ['dfe4ed', 'Hides from changelog'],
        ],
        'delete' => [
            'documentation',
            'duplicate',
            'enhancement',
            'fixed',
            'fixing',
            'good first issue',
            'help wanted',
            'invalid',
            'question',
            'wontfix',
        ],
    ],
];
