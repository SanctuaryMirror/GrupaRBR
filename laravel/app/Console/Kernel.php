<?php

namespace App\Console;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $tomorrow = Carbon::tomorrow()->toDateString();

            Task::whereDate('due_date', $tomorrow)
                ->where('status', '!=', 'done')
                ->with('user')
                ->get()
                ->each(function ($task) {
                    if ($task->user && $task->user->email) {
                        Mail::to($task->user->email)->queue(new \App\Mail\TaskDueTomorrow($task));
                    }
                });
        })->dailyAt('01:00');

    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
