<?php

declare(strict_types=1);

use App\Http\Controllers\PullRequestController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\RepositoryController;

app('router')
    ->name('pull_requests.')
    ->prefix('pull-requests')
    ->controller(PullRequestController::class)
    ->group(static function () {
        app('router')->post('assign', 'assign')->name('assign');
        app('router')->post('dependabot', 'dependabot')->name('dependabot');
        app('router')->post('merge', 'merge')->name('merge');
    });

app('router')
    ->name('releases.')
    ->prefix('releases')
    ->controller(ReleaseController::class)
    ->group(static function () {
        app('router')->post('publish', 'publish')->name('publish');
    });

app('router')
    ->name('repositories.')
    ->prefix('repositories')
    ->controller(RepositoryController::class)
    ->group(static function () {
        app('router')->post('create', 'create')->name('create');
    });
