<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function success(): JsonResponse
    {
        return response()->json('ok');
    }
}
