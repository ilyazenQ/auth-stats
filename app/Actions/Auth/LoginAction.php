<?php

namespace App\Actions\Auth;

use App\Actions\ActionInterface;
use App\Services\JWT\JWTService;
use Illuminate\Http\JsonResponse;

class LoginAction implements ActionInterface 
{
    public function execute(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return JWTService::respondWithToken($token);
    }
}