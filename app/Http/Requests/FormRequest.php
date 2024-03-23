<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Spatie\LaravelData\Data;

abstract class FormRequest extends BaseFormRequest
{
    protected Data|string $data;

    abstract public function rules(): array;

    public function dto(): Data
    {
        return $this->data::from($this->validated());
    }
}
