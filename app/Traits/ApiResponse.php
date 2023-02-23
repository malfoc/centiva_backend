<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse {

    private function successResponse($data, $code)
    {
        return response()->json(['response' => $data], $code);
    }

    protected function showAll(Collection $collection, $code = Response::HTTP_OK) {
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = Response::HTTP_OK) {
        return $this->successResponse($instance, $code);
    }

    protected function errorResponse($message, $code) {
        return response()->json(['error' => $message], $code);
    }

}