<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Collection;

readonly class InCollectionRule implements ValidationRule
{
    public function __construct(
        protected string $key,
        protected array|string $values
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_array($value)) {
            $fail('validation.array')->translate();
        }

        if (! $this->has(collect($value))) {
            $fail('validation.in')->translate();
        }
    }

    protected function has(Collection $labels): bool
    {
        foreach ((array) $this->values as $label) {
            if ($labels->contains($this->key, $label)) {
                return true;
            }
        }

        return false;
    }
}
