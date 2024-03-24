<?php

declare(strict_types=1);

use App\Http\Controllers\GitHubController;

app('router')
    ->name('github.')
    ->controller(GitHubController::class)
    ->group(static function () {
        app('router')->post('assign', 'assign')->name('assign');
        app('router')->post('dependabot', 'dependabot')->name('dependabot');
        app('router')->post('merge', 'merge')->name('merge');
        app('router')->post('release', 'release')->name('release');
        app('router')->post('repository', 'repository')->name('repository');
    });
