<?php

declare(strict_types=1);

use DragonCode\LaravelDeployOperations\Operation;
use GrahamCampbell\GitHub\GitHubManager;

return new class extends Operation {
    public function needBefore(): bool
    {
        return false;
    }

    protected string $organization = 'Laravel-Lang';

    public function __invoke(GitHubManager $github): void
    {
        foreach ($this->repositories($github) as $repository) {
            foreach ($this->webhooks($github, $repository['name']) as $webhook) {
                $this->remove($github, $repository['name'], $webhook['id']);
            }
        }
    }

    protected function remove(GitHubManager $github, string $repository, int $id): void
    {
        $github->repository()->hooks()->remove($this->organization, $repository, $id);
    }

    protected function repositories(GitHubManager $github): array
    {
        return $github->organization()->repositories($this->organization);
    }

    protected function webhooks(GitHubManager $github, string $repository): array
    {
        return $github->repository()->hooks()->all($this->organization, $repository);
    }
};
