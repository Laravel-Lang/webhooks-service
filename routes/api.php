<?php

declare(strict_types=1);

use App\Http\Controllers\GitHubController;

app('router')
    ->name('github.')
    ->controller(GitHubController::class)
    ->group(static function () {
        app('router')
            ->name('release')
            ->post('release', 'release');

        app('router')
            ->name('dependabot')
            ->post('dependabot', 'dependabot');
    });
