<?php

namespace App\Services;

use App\Mail\PasswordResetCodeMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class PasswordResetMailer
{
    public function send(string $email, string $code, int $ttlMinutes): void
    {
        $apiKey = config('services.resend.key');

        if (! $apiKey) {
            Mail::to($email)->send(new PasswordResetCodeMail($code, $ttlMinutes));

            return;
        }

        $response = Http::withToken($apiKey)
            ->acceptJson()
            ->post('https://api.resend.com/emails', [
                'from' => config('mail.from.address'),
                'to' => [$email],
                'subject' => 'Код для сброса пароля AniYume',
                'html' => view('emails.password-reset-code', [
                    'code' => $code,
                    'ttlMinutes' => $ttlMinutes,
                ])->render(),
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('Resend rejected password reset email: '.$response->body());
        }
    }
}
