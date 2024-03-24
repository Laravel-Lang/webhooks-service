<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\PullRequestData;
use App\Rules\InCollectionRule;
use Spatie\LaravelData\Data;

/** @method PullRequestData dto() */
class TranslationRequest extends FormRequest
{
    protected Data|string $data = PullRequestData::class;

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:opened,edited,labeled'],

            'repository'             => ['required', 'array'],
            'repository.name'        => ['required', 'string'],
            'repository.owner.login' => ['required', 'string'],

            'pull_request'          => ['required', 'array'],
            'pull_request.number'   => ['required', 'numeric'],
            'pull_request.head.sha' => ['required', 'string'],
            'pull_request.title'    => ['required', 'string'],
            'pull_request.body'     => ['required', 'string'],

            'pull_request.state'  => ['required', 'string', 'in:open'],
            'pull_request.locked' => ['required', 'bool', 'declined'],
            'pull_request.draft'  => ['required', 'bool', 'declined'],
            'pull_request.labels' => ['required', 'array', new InCollectionRule('name', 'machine')],
        ];
    }
}
