<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AssignRequest;
use App\Http\Requests\DependabotRequest;
use App\Http\Requests\ReleaseRequest;
use App\Http\Requests\TranslationRequest;
use App\Services\Dependabot;
use App\Services\PullRequest;
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

    public function translation(TranslationRequest $request, PullRequest $pullRequest)
    {
        $pullRequest->approveMachine($request->dto());

        return $this->success();
    }

    public function assign(AssignRequest $request, PullRequest $pullRequest)
    {
        $pullRequest->assign($request->dto());

        return $this->success();
    }
}
