<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class NewAppointmentNotification extends Notification
{
    use Queueable;
    use Notifiable;

    protected $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Storing notifications in the database
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
        'id' => $this->appointment->id,
        'name' => $this->appointment->user->name ?? 'Unknown',
        'email' => $this->appointment->user->email ?? 'No Email',
        'service' => $this->appointment->service ?? 'No Service',
        'date' => $this->appointment->date,
        'time' => $this->appointment->time ?? 'No Time',
        ];
    }
}
