<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GitHubMiddleware
{
    protected const ALGO        = 'sha256';
    protected const AUTH_HEADER = 'X-Hub-Signature-256';
    protected const PING_HEADER = 'X-GitHub-Event';

    public function handle(Request $request, Closure $next)
    {
        $this->throw(fn () => $this->signature($request));
        $this->throw(fn () => $this->hashed($request));

        if ($this->hasCreatedHook($request)) {
            return response()->json('pong');
        }

        return $next($request);
    }

    protected function hasCreatedHook(Request $request): bool
    {
        return $request->header(self::PING_HEADER) === 'ping';
    }

    protected function throw(Closure $callback): void
    {
        abort_unless($callback(), 401, __('Unauthorized'));
    }

    protected function hashed(Request $request): bool
    {
        return hash_equals($this->signature($request), $this->hash($request));
    }

    protected function hash(Request $request): string
    {
        return hash_hmac(self::ALGO, $request->getContent(), $this->secret());
    }

    protected function signature(Request $request): ?string
    {
        return Str::after($request->header(self::AUTH_HEADER), '=');
    }

    protected function secret(): string
    {
        return config('services.github.token');
    }
}
