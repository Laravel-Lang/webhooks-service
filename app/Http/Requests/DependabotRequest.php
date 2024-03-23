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

            'pull_request'        => ['required', 'array'],
            'pull_request.state'  => ['required', 'string', 'in:open'],
            'pull_request.number' => ['required', 'numeric'],

            'sender'    => ['required', 'array'],
            'sender.id' => ['required', 'numeric', Rule::in(config('github.dependabot.id'))],

            'organization'       => ['required', 'array'],
            'organization.login' => ['required', 'string'],

            'repository'      => ['required', 'array'],
            'repository.name' => ['required', 'string'],
        ];
    }
}
