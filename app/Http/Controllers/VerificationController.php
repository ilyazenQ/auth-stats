<?php

namespace App\Http\Controllers;

use App\Actions\Verification\ResendAction;
use App\Actions\Verification\VerifyAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{

    public function verify(int $id, mixed $hash, VerifyAction $action): JsonResponse
    {
        return $action->execute($id, $hash);
    }

    public function resend(Request $request, ResendAction $action): JsonResponse
    {
        return $action->execute($request);
    }
    
}
