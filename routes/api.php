<?php

declare(strict_types=1);

use App\Http\Controllers\GitHubController;

app('router')
    ->name('release')
    ->controller(GitHubController::class)
    ->post('release', 'release');
