<?php

declare(strict_types=1);

namespace App\Jobs;

use Closure;
use DragonCode\Support\Facades\Instances\Instance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

abstract class Job implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected function releaseAfter(Closure $callback, string $exceptionClass, int $minutes = 30): void
    {
        try {
            $callback();
        }
        catch (Throwable $e) {
            if (Instance::of($e, $exceptionClass)) {
                $this->release($minutes * 60);

                return;
            }

            throw $e;
        }
    }
}
