<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AssignRequest;
use App\Http\Requests\AutoMergeRequest;
use App\Http\Requests\DependabotRequest;
use App\Services\PullRequest;

class PullRequestController extends Controller
{
    public function __construct(
        protected readonly PullRequest $pullRequest
    ) {}

    public function assign(AssignRequest $request)
    {
        $this->pullRequest->assign($request->dto());

        return $this->success();
    }

    public function dependabot(DependabotRequest $request)
    {
        $this->pullRequest->dependabot($request->dto());

        return $this->success();
    }

    public function merge(AutoMergeRequest $request)
    {
        $this->pullRequest->autoMerge($request->dto());

        return $this->success();
    }
}
