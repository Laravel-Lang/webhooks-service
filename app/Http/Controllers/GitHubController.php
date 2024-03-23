<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DependabotRequest;
use App\Http\Requests\ReleaseRequest;
use App\Services\Dependabot;
use App\Services\Telegram;

class GitHubController extends Controller
{
    public function release(ReleaseRequest $request, Telegram $telegram)
    {
        $telegram->publish($request->dto());

        return $this->success();
    }

    public function dependabot(DependabotRequest $request, Dependabot $dependabot)
    {
        $dependabot->merge($request->dto());

        return $this->success();
    }
}
