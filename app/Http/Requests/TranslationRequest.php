<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PullRequestData;
use App\Rules\HasLabelRule;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/** @method PullRequestData dto() */
class TranslationRequest extends FormRequest
{
    protected Data|string $data = PullRequestData::class;

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:opened,edited,labeled'],

            'pull_request'          => ['required', 'array'],
            'pull_request.state'    => ['required', 'string', 'in:open'],
            'pull_request.locked'   => ['required', 'bool', 'declined'],
            'pull_request.draft'    => ['required', 'bool', 'declined'],
            'pull_request.number'   => ['required', 'numeric'],
            'pull_request.head.sha' => ['required', 'string'],
            'pull_request.labels'   => ['required', 'array', new HasLabelRule('machine')],

            'sender'    => ['required', 'array'],
            'sender.id' => ['required', 'numeric', Rule::in(config('github.actions.id'))],

            'organization'       => ['required', 'array'],
            'organization.login' => ['required', 'string'],

            'repository'      => ['required', 'array'],
            'repository.name' => ['required', 'string'],
        ];
    }
}
