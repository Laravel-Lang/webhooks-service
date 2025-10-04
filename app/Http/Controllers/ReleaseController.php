<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReleaseRequest;
use App\Services\Release;

class ReleaseController extends Controller
{
    public function __construct(
        protected readonly Release $release
    ) {}

    public function publish(ReleaseRequest $request)
    {
        $this->release->publish($request->dto());

        return $this->success();
    }
}
