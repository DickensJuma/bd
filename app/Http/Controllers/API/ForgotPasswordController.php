<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * @group  Password Control
 *
 * APIs for Managing password reset
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response(['message' => $response],200);

    }


    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response(['error' => $response], 422);

    }
}
