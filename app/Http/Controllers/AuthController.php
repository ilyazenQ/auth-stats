<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\DTO\User\UserRegisterDTO;
use App\Http\Requests\RegisterRequest;
use App\Services\JWT\JWTService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action, UserRegisterDTO $DTO): JsonResponse
    {    
        return $action->execute($DTO->fillFromFields($request->validated()));
    }
    
    public function login(LoginAction $action): JsonResponse
    {
        return $action->execute();
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return JWTService::respondWithToken(auth()->refresh());
    }
       
}
