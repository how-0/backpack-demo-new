<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ticketData;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticketData)
    {
        $this->ticketData = $ticketData;

        $this->onQueue('emails');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Notification: Ticket Removed #' . $this->ticketData['id'])
            ->greeting('Hello.')
            ->line('The ticket regarding "' . $this->ticketData['inquiry'] . '" has been deleted from our system.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
