<?php

namespace App\Services\JWT;

use Illuminate\Http\JsonResponse;

class JWTService
{
    public static function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}