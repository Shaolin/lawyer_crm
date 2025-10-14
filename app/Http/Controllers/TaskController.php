<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskAssignedSmsNotification;

class TaskController extends Controller
{
    // public function index()
    // {
    //     $tasks = Auth::user()->role === 'admin'
    //         ? Task::with(['legalCase', 'project', 'user'])->latest()->get()
    //         : Task::with(['legalCase', 'project', 'user'])
    //             ->where('user_id', Auth::id())
    //             ->latest()
    //             ->get();

    //     return view('dashboard.tasks.index', compact('tasks'));
    // }
    public function index()
{
    $tasks = Auth::user()->role === 'admin'
        ? Task::with(['legalCase', 'project', 'user'])->latest()->paginate(5) // 10 per page
        : Task::with(['legalCase', 'project', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

    return view('dashboard.tasks.index', compact('tasks'));
}


    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $cases = LegalCase::all();
            $projects = Project::all();
            $lawyers = User::where('role', 'lawyer')->get();
        } else {
            $cases = LegalCase::where('user_id', Auth::id())->get();
            $projects = Project::where('user_id', Auth::id())->get();
            $lawyers = collect();
        }

        return view('dashboard.tasks.create', compact('cases', 'projects', 'lawyers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'due_date'       => 'required|date',
            'status'         => 'required|in:pending,completed,cancelled',
            'type'           => 'required|in:litigation,non_litigation',
            'priority'       => 'required|in:high,medium,low',
            'legal_case_id'  => 'nullable|exists:legal_cases,id',
            'project_id'     => 'nullable|exists:projects,id',
            'assigned_to'    => 'nullable|exists:users,id',
        ]);

        // ✅ Determine who to assign
        $assignedUserId = Auth::user()->role === 'admin'
            ? ($request->filled('assigned_to') ? $request->assigned_to : Auth::id())
            : Auth::id();

        $task = Task::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'due_date'        => $request->due_date,
            'status'          => $request->status,
            'type'            => $request->type,
            'priority'        => $request->priority,
            'user_id'         => $assignedUserId,
            'legal_case_id'   => $request->legal_case_id,
            'project_id'      => $request->project_id,
            'organization_id' => Auth::user()->organization_id ?? null,
        ]);

        
        // after creating $task
        // Log::info('Assigned user ID: ' . $assignedUserId);

$assignedUser = User::find($assignedUserId);

if ($assignedUser && $assignedUser->phone) {
    $organization = $task->organization; // assuming relation exists
    $assignedUser->notify(new \App\Notifications\TaskAssignedSmsNotification($task, $organization));
}

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task created successfully' . ($assignedUser && $assignedUser->phone ? ' and SMS sent!' : '.'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        if (Auth::user()->role === 'admin') {
            $cases = LegalCase::all();
            $projects = Project::all();
            $lawyers = User::where('role', 'lawyer')->get();
        } else {
            $cases = LegalCase::where('user_id', Auth::id())->get();
            $projects = Project::where('user_id', Auth::id())->get();
            $lawyers = collect();
        }

        return view('dashboard.tasks.edit', compact('task', 'cases', 'projects', 'lawyers'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'due_date'       => 'required|date',
            'status'         => 'required|in:pending,completed,cancelled',
            'type'           => 'required|in:litigation,non_litigation',
            'priority'       => 'required|in:high,medium,low',
            'legal_case_id'  => 'nullable|exists:legal_cases,id',
            'project_id'     => 'nullable|exists:projects,id',
            'assigned_to'    => 'nullable|exists:users,id',
        ]);

        $data = $request->except('assigned_to');

        if (Auth::user()->role === 'admin') {
            $data['user_id'] = $request->filled('assigned_to')
                ? $request->assigned_to
                : Auth::id();
        } else {
            $data['user_id'] = $task->user_id;
        }

        $task->update($data);

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['user', 'legalCase', 'project']);
        return view('dashboard.tasks.show', compact('task'));
    }
}
