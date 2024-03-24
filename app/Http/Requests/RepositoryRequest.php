<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\RepositoryData;
use Spatie\LaravelData\Data;

/** @method RepositoryData dto() */
class RepositoryRequest extends FormRequest
{
    protected Data|string $data = RepositoryData::class;

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:created'],

            'repository'             => ['required', 'array'],
            'repository.name'        => ['required', 'string'],
            'repository.owner.login' => ['required', 'string'],
        ];
    }
}
