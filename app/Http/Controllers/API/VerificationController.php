<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * @group  Verification
 *
 * APIs for Managing account verification
 */
class VerificationController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Email Verification Controller
   |--------------------------------------------------------------------------
   |
   | This controller is responsible for handling email verification for any
   | user that recently registered with the application. Emails may also
   | be re-sent if the user didn't receive the original email message.
   |
   */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $user = User::where('email',$request->route('email'))->firstOrFail();

        if ($user->hasVerifiedEmail()) {

            return response(['message'=>'Already verified']);
        }

        $user->sendEmailVerificationNotification();

        if ($request->wantsJson()) {
            return response(['message' => 'Email Sent']);
        }

        return back()->with('resent', true);
    }


    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function verify(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if (!URL::hasValidSignature($request)) {
            return response()->json(["errors" => [
                'message' => 'Invalid verification link'
            ]], 422);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(["errors" => [
                'message' => 'Already verified'
            ]], 422);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json( [
            'message' => 'Successfully verified'
        ], 200);
    }

    /*public function verify(Request $request)
        {
            auth()->loginUsingId($request->route('id'));

            if ($request->route('id') != $request->user()->getKey()) {
                throw new AuthorizationException;
            }

            if ($request->user()->hasVerifiedEmail()) {

                return response(['message'=>'Already verified']);

                // return redirect($this->redirectPath());
            }

            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }

            return response(['message'=>'Successfully verified']);

        }*/




}
