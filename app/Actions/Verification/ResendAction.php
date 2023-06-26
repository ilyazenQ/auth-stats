<?php

namespace App\Actions\Verification;

use App\Actions\ActionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResendAction implements ActionInterface
{
    public function execute(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified'], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent']);
    }
}