<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\ReleaseData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PullRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:released'],

            'release' => ['required', 'array'],

            'release.name' => ['required', 'string'],
            'release.body' => ['required', 'string'],

            'release.draft' => ['required', 'bool', 'declined'],

            'release.html_url' => ['required', 'url'],

            'repository.owner.login' => ['required', 'string'],
            'repository.name'        => ['required', 'string', Rule::notIn(config('services.telegram.excludes'))],
            'repository.full_name'   => ['required', 'string', 'regex:/([\d\w\-_])+\/([\d\w\-_])+/'],

            'repository.visibility' => ['required', 'string', 'in:public'],

            'repository.private'     => ['required', 'bool', 'declined'],
            'repository.archived'    => ['required', 'bool', 'declined'],
            'repository.disabled'    => ['required', 'bool', 'declined'],
            'repository.is_template' => ['required', 'bool', 'declined'],
        ];
    }

    public function dto(): ReleaseData
    {
        return ReleaseData::from($this->validated());
    }
}
