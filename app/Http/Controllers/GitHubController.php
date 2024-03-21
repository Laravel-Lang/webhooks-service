<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PullRequest;
use App\Services\Telegram;

class GitHubController extends Controller
{
    public function __invoke(PullRequest $request, Telegram $telegram)
    {
        $telegram->publish($request->dto());

        return response()->json('ok');
    }
}
