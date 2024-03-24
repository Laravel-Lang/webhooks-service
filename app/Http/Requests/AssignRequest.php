<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PullRequestData;
use Spatie\LaravelData\Data;

/** @method PullRequestData dto() */
class AssignRequest extends FormRequest
{
    protected Data|string $data = PullRequestData::class;

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:opened'],

            'repository'             => ['required', 'array'],
            'repository.name'        => ['required', 'string'],
            'repository.owner.login' => ['required', 'string'],

            'pull_request'            => ['required', 'array'],
            'pull_request.user.login' => ['required', 'string'],
            'pull_request.number'     => ['required', 'numeric'],
            'pull_request.title'      => ['required', 'string'],

            'pull_request.state'  => ['required', 'string', 'in:open'],
            'pull_request.locked' => ['required', 'bool', 'declined'],
            'pull_request.draft'  => ['required', 'bool', 'declined'],
        ];
    }
}
