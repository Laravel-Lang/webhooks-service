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
];
