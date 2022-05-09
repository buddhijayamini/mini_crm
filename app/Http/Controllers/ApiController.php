<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected static function errorResponse(string $code, string $message, int $status = 500, array $failures = null): JsonResponse
    {
        $err = [
            'code' => $code,
            'message' => $message,
        ];

        if (! is_null($failures)) {
            $err['failures'] = $failures;
        }

        return response()->json($err, $status);
    }

    protected static function successResponse(string $message, int $status = 200): JsonResponse
    {
        $o = [
            'message' => $message,
        ];

        return response()->json($o, $status);
    }

    /**
     * Returns an unauthorized (401) JSON response.
     *
     * @param  array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseUnauthorized($errors = ['Unauthorized.'])
    {
        return response()->json([
            'status' => 401,
            'errors' => $errors,
        ], 401);
    }

    /**
     * Returns a unprocessable entity (422) JSON response.
     *
     * @param  array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseUnprocessable($errors)
    {
        return response()->json([
            'status' => 422,
            'errors' => $errors,
        ], 422);
    }

    /**
     * Returns a server error (500) JSON response.
     *
     * @param  array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseServerError($errors = ['Server error.'])
    {
        return response()->json([
            'status' => 500,
            'errors' => $errors
        ], 500);
    }
}
