<?php

namespace App\Actions\Verification;

use App\Actions\ActionInterface;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;

class VerifyAction implements ActionInterface
{
    public function execute(int $id, mixed $hash): JsonResponse
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['error' => 'Hash doesnt exists'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['error' => 'Your account has already been verified.'], 400);
        }
        $user->markEmailAsVerified();
        $user->markUserAsVerified();
        event(new Verified($user));
        return response()->json(['success' => 'Your account has been successfully verified.'], 200);
    }
}