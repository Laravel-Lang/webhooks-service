<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use App\Services\Repository;

class RepositoryController extends Controller
{
    public function __construct(
        protected readonly Repository $repository
    ) {
    }

    public function create(RepositoryRequest $request)
    {
        $this->repository->connect($request->dto());

        return $this->success();
    }
}
