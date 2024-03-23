<?php

declare(strict_types=1);

use App\Http\Controllers\GitHubController;

app('router')
    ->name('github.')
    ->controller(GitHubController::class)
    ->group(static function () {
        app('router')->post('release', 'release')->name('release');
        app('router')->post('dependabot', 'dependabot')->name('dependabot');
        app('router')->post('translation', 'translation')->name('translation');
        app('router')->post('assign', 'assign')->name('assign');
    });
