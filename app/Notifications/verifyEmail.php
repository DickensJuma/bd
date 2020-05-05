<?php

namespace App\Notifications;

use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Carbon\Carbon;

class verifyEmail extends Notification
{
    protected function verificationUrl($notifiable)
    {
        $clientUrl = env('FRONT_APP');
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return str_replace(url('/api/v1'), $clientUrl, $url);
    }
}
