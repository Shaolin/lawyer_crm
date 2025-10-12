<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    public $task;
    public $organization;

    public function __construct($task, $organization)
    {
        $this->task = $task;
        $this->organization = $organization;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Dynamic SMTP for this organization
        Config::set('mail.mailers.smtp.host', $this->organization->smtp_host);
        Config::set('mail.mailers.smtp.port', $this->organization->smtp_port);
        Config::set('mail.mailers.smtp.username', $this->organization->smtp_username);
        Config::set('mail.mailers.smtp.password', $this->organization->smtp_password);
        Config::set('mail.mailers.smtp.encryption', $this->organization->smtp_encryption);
        Config::set('mail.from.address', $this->organization->email);
        Config::set('mail.from.name', $this->organization->name);

        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name)
            ->line('A new task has been assigned to you.')
            ->line('Title: ' . $this->task->title)
            ->line('Description: ' . ($this->task->description ?? 'No description'))
            ->line('Priority: ' . $this->task->priority)
            ->line('Due Date: ' . ($this->task->due_date ? $this->task->due_date->format('M d, Y') : 'Not set'))
            ->action('View Task', url('/dashboard/tasks/' . $this->task->id))
            ->line('Thank you for using our system!');
    }
}
