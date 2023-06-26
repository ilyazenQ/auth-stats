<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{

    public function verify(int $id, mixed $hash): JsonResponse
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['error' => 'Hash doesnt exists'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['error' => 'Your account has already been verified.'], 400);
        }
        $user->is_verified = 1;
        $user->markEmailAsVerified();
        event(new Verified($user));
        $user->save();
        return response()->json(['success' => 'Your account has been successfully verified.'], 200);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified'], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent']);
    }
    
}
