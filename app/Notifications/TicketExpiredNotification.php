<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketExpiredNotification extends Notification
{
    use Queueable;

    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Ticket Has Expired')
            ->line('Your ticket ' . $this->ticket->ticket_number . ' has expired.')
            ->line('Please request a new ticket if needed.')
            ->action('Request New Ticket', url('/dashboard'))
            ->line('Thank you for using our service.');
    }

    /**
     * Store the notification in the database.
     */
    public function toArray($notifiable)
    {
        return [
            'ticket_number' => $this->ticket->ticket_number,
            'message' => 'Your ticket has expired.',
        ];
    }
}
