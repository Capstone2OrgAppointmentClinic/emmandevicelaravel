<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
class AppointmentStatusNotification extends Notification
{
    use Queueable;

    public $appointment;
    public $status;

    public function __construct($appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $status = strtolower($this->status);

        $dateTime = Carbon::parse("{$this->appointment->date} {$this->appointment->time}")
            ->timezone('Asia/Manila');
    
        $formattedDate = $dateTime->format('F j, Y');
        $formattedTime = $dateTime->format('g:i A');
    
        if ($status === 'done') {
            $message = "Your appointment for {$this->appointment->service} on {$formattedDate} at {$formattedTime} is done. Thank you!";
        } elseif ($status === 'canceled') {
            $message = "Your appointment for {$this->appointment->service} on {$formattedDate} at {$formattedTime} has been canceled.";
        } elseif ($status === 'approved') {
            $message = "Your appointment for {$this->appointment->service} on {$formattedDate} at {$formattedTime} has been approved.";
        }
         else {
            $message = "Your appointment for {$this->appointment->service} on {$formattedDate} at {$formattedTime} has been {$this->status}.";
        }
    
        return [
            'message' => $message,
            'appointment_id' => $this->appointment->id,
        ];
    }
}
