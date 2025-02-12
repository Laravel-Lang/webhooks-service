<?php

declare(strict_types=1);

namespace App\Services;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Arr;

class User
{
    public function __construct(
        protected GitHubManager $github,
    ) {
    }

    public function isMe(?int $userId): bool
    {
        if (is_null($userId)) {
            return false;
        }

        return $userId === Arr::get($this->me(), 'id');
    }

    public function me(): array
    {
        return $this->github->me()->show();
    }
}
