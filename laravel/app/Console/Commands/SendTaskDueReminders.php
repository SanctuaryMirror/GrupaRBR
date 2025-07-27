<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskDueTomorrow;
use Carbon\Carbon;

class SendTaskDueReminders extends Command
{
    protected $signature = 'tasks:send-due-reminders';
    protected $description = 'Wysyła powiadomienia e-mail o zadaniach, których termin upływa jutro';

    public function handle(): int
    {
        $tomorrow = Carbon::tomorrow();

        $tasks = Task::whereDate('due_date', $tomorrow)->with('user')->get();

        foreach ($tasks as $task) {
            if ($task->user && $task->user->email) {
                Mail::to($task->user->email)->queue(new TaskDueTomorrow($task));
            }
        }

        $this->info("Wysłano przypomnienia dla " . $tasks->count() . " zadań.");

        return Command::SUCCESS;
    }
}

