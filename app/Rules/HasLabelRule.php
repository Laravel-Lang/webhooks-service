<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

readonly class HasLabelRule implements ValidationRule
{
    public function __construct(
        public string $label
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_array($value)) {
            $fail('validation.array')->translate();
        }

        if ($this->has($value)) {
            $fail('validation.in')->translate();
        }
    }

    protected function has(array $labels): bool
    {
        return collect($labels)->contains('name', $this->label);
    }
}
