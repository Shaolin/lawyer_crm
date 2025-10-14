<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        Log::info('SmsChannel starting', [
            'notifiable' => get_class($notifiable),
            'notification' => get_class($notification),
        ]);

        // Ensure the notification has the toSms() method
        if (! method_exists($notification, 'toSms')) {
            Log::error('SmsChannel: Notification missing toSms() method.');
            return;
        }

        try {
            $payload = $notification->toSms($notifiable);
            Log::info('SmsChannel payload', $payload ?? []);
        } catch (\Throwable $e) {
            Log::error('SmsChannel: Error calling toSms()', [
                'error' => $e->getMessage(),
            ]);
            return;
        }

        $to = $payload['to'] ?? null;
        $message = $payload['message'] ?? null;

        if (! $to || ! $message) {
            Log::error('SmsChannel: Missing "to" or "message" in payload.', $payload);
            return;
        }

        $apiKey   = config('services.termii.api_key');
        $senderId = config('services.termii.sender_id');
        $baseUrl  = config('services.termii.base_url');

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->asJson()->post($baseUrl, [
                'to'      => $to,
                'from'    => $senderId,
                'sms'     => $message,
                'type'    => 'plain',
                'api_key' => $apiKey,
                'channel' => 'generic',
            ]);
            

            if ($response->failed()) {
                Log::error('SmsChannel: Termii API Error', [
                    'status'   => $response->status(),
                    'response' => $response->body(),
                ]);
            } else {
                Log::info('SmsChannel: SMS sent successfully', [
                    'to'       => $to,
                    'response' => $response->json(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('SmsChannel Exception', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
