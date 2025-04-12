<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RescheduleNotification extends Notification
{
    use Queueable;

    protected $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Determine which channels the notification should be sent to.
     */
    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->appointment->name,
            'service' => $this->appointment->service,
            'date' => $this->appointment->date,
            'time' => date('h:i A', strtotime($this->appointment->time)),
            'reason' => $this->appointment->message,
            'status' => 'Rescheduled',
        ];
    }
}
