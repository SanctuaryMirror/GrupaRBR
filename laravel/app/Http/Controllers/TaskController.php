<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $task = new Task($request->validated());
        $task->user_id = Auth::id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Zadanie utworzone.');
    }

    // Szczegóły
    public function show(Task $task)
    {
        $histories = $task->histories()->with('user')->latest()->get();
        return view('tasks.show', compact('task', 'histories'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $original = $task->getOriginal();

        $task->update($request->validated());

        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'name' => $original['name'],
            'description' => $original['description'],
            'priority' => $original['priority'],
            'status' => $original['status'],
            'due_date' => $original['due_date'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Zadanie zaktualizowane.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Zadanie usunięte.');
    }

    public function generatePublicLink(Task $task, Request $request)
    {
        $token = Str::random(32);

        $task->public_token = $token;
        $task->token_expiry = Carbon::now()->addMinutes(60);
        $task->save();

        $link = route('tasks.public.show', ['task' => $task->id, 'token' => $token]);

        return redirect()->route('tasks.show', $task)->with('public_link', $link);
    }

    public function showPublic(Task $task, $token)
    {
        if ($task->public_token !== $token || $task->token_expiry->isPast()) {
            abort(403, 'Link jest nieprawidłowy lub wygasł.');
        }

        return view('tasks.show_public', compact('task'));
    }

    public function history(Task $task)
    {
        $histories = $task->histories()->latest()->get();
        return view('tasks.history', compact('task', 'histories'));
    }
}
