<?php

namespace App\Actions\Auth;

use App\Actions\ActionInterface;
use App\DTO\DTOInterface;
use App\Models\User;
use App\Services\Telegram\TelegramService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterAction implements ActionInterface
{
    public function execute(DTOInterface $userRegisterDTO): JsonResponse 
    {
        $user = User::createFromDTO($userRegisterDTO);

        event(new Registered($user));

        $token = Auth::login($user);
        TelegramService::sendMessage('New user!');
        
        return response()->json([
            'message' => 'Registration successful, check email',
            'token' => $token,
            'user' => $user
        ], 201);
    }
}