<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Broadcasting\SmsChannel;

class TaskAssignedSmsNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $organization;

    public function __construct($task, $organization = null)
    {
        $this->task = $task;
        $this->organization = $organization;
    }

    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Returns the SMS payload used by SmsChannel.
     */
    public function toSms($notifiable)
    {
        // Format the due date to only show the day (YYYY-MM-DD)
        $dueDate = $this->task->due_date->format('Y-m-d');

        return [
            'to' => $notifiable->phone,
            'message' => "New Task Assigned:\n{$this->task->title}\nDeadline: {$dueDate}\n- Crystal CRM",
        ];
    }
}
