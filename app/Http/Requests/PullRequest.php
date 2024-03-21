<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\ReleaseData;
use App\Enums\ActionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PullRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', Rule::enum(ActionEnum::class)],

            'release' => ['required', 'array'],

            'release.name' => ['required', 'string'],
            'release.body' => ['required', 'string'],

            'release.draft' => ['required', 'bool', 'declined'],
            'release.prerelease' => ['required', 'bool', 'declined'],

            'release.html_url' => ['required', 'url'],

            'repository.owner.login' => ['required', 'string'],
            'repository.name' => ['required', 'string'],
        ];
    }

    public function dto(): ReleaseData
    {
        return ReleaseData::from($this->validated());
    }
}
