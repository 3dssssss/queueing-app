<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client; 


class UserTurnNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['twilio_sms'];
    }

    public function toTwilioSms($notifiable)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $message = "Your ticket #{$this->ticket->ticket_number} is now Active. Please proceed to {$this->ticket->queue_name}.";

        return $twilio->messages->create(
            $notifiable->phone, // User's phone number
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message
            ]
        );
    }
}
