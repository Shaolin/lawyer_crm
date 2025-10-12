<?php

namespace App\Console;

use App\Models\Task;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\TaskAssignedNotification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // Get all pending tasks with eager-loaded user and organization
            $tasks = Task::where('status', 'pending')->with(['user', 'organization'])->get();

            foreach ($tasks as $task) {

                // Skip if no assigned user or organization
                if (!$task->user || !$task->organization) {
                    continue;
                }

                // Only notify if the frequency allows it
                if ($task->shouldNotify()) {

                    // Send notification
                    $task->user->notify(new TaskAssignedNotification($task, $task->organization));

                    // Update last_notified_at timestamp
                    $task->update(['last_notified_at' => now()]);
                }
            }
        })->everyMinute(); // use ->daily() or ->hourly() in production
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
