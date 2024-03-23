<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\AssignData;
use App\Data\TranslationData;
use App\Jobs\GitHub\AutoMergeJob;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Str;

class PullRequest
{
    public function __construct(
        protected GitHubManager $github
    ) {}

    public function machine(TranslationData $data): void
    {
        AutoMergeJob::dispatch($data);
    }

    public function approve(TranslationData $data): void
    {
        $this->github->pullRequest()->reviews()->create(
            $data->organization,
            $data->repository,
            $data->pullRequestId,
            ['event' => 'APPROVE', 'body' => 'Auto approve']
        );
    }

    public function merge(TranslationData $data): void
    {
        $this->github->pullRequest()->merge(
            $data->organization,
            $data->repository,
            $data->pullRequestId,
            $data->body,
            $data->hash
        );
    }

    public function assign(AssignData $data): void
    {
        Str::of($data->title)
            ->matchAll('/\[([\w\-,\s]+)\]:.+/')
            ->map(function (string $match) {
                $team = config('github.team', []);

                return Str::of($match)->explode(',')->map(
                    fn (string $locale) => $team[trim($locale)] ?? false
                );
            })
            ->flatten()
            ->filter()
            ->unique()
            ->each(fn (string $user) => $this->github->issues()->assignees()->add(
                $user,
                $data->organization,
                $data->pullRequestId
            ));
    }
}
