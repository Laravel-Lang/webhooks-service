<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PullRequestData;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/** @method PullRequestData dto() */
class DependabotRequest extends FormRequest
{
    protected Data|string $data = PullRequestData::class;

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:opened'],

            'repository'             => ['required', 'array'],
            'repository.name'        => ['required', 'string'],
            'repository.owner.login' => ['required', 'string'],

            'pull_request'        => ['required', 'array'],
            'pull_request.number' => ['required', 'numeric'],

            'pull_request.state'  => ['required', 'string', 'in:open'],
            'pull_request.locked' => ['required', 'bool', 'declined'],
            'pull_request.draft'  => ['required', 'bool', 'declined'],

            'sender'    => ['required', 'array'],
            'sender.id' => ['required', 'numeric', Rule::in(config('github.dependabot.id'))],
        ];
    }
}
