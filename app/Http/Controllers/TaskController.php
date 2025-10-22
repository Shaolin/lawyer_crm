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
    public function index()
    {
        $user = Auth::user();

        $tasks = Task::with(['legalCase', 'project', 'user'])
            ->where('organization_id', $user->organization_id)
            ->when($user->role !== 'admin', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->paginate(6);

        return view('dashboard.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $cases = LegalCase::where('organization_id', $user->organization_id)->get();
            $projects = Project::where('organization_id', $user->organization_id)->get();
            $lawyers = User::where('role', 'lawyer')
                ->where('organization_id', $user->organization_id)
                ->get();
        } else {
            $cases = LegalCase::where('user_id', $user->id)->get();
            $projects = Project::where('user_id', $user->id)->get();
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

        $user = Auth::user();

        // ✅ Determine who to assign
        $assignedUserId = $user->role === 'admin'
            ? ($request->filled('assigned_to') ? $request->assigned_to : $user->id)
            : $user->id;

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
            'organization_id' => $user->organization_id,
        ]);

        // 🔔 Send SMS if assigned user has a phone
        $assignedUser = User::find($assignedUserId);

        if ($assignedUser && $assignedUser->phone) {
            $organization = $task->organization ?? null;
            $assignedUser->notify(new TaskAssignedSmsNotification($task, $organization));
        }

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task created successfully' . ($assignedUser && $assignedUser->phone ? ' and SMS sent!' : '.'));
    }

    public function show(Task $task)
    {
        $this->authorizeAccess($task);

        $task->load(['user', 'legalCase', 'project']);
        return view('dashboard.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorizeAccess($task);

        $user = Auth::user();

        if ($user->role === 'admin') {
            $cases = LegalCase::where('organization_id', $user->organization_id)->get();
            $projects = Project::where('organization_id', $user->organization_id)->get();
            $lawyers = User::where('role', 'lawyer')
                ->where('organization_id', $user->organization_id)
                ->get();
        } else {
            $cases = LegalCase::where('user_id', $user->id)->get();
            $projects = Project::where('user_id', $user->id)->get();
            $lawyers = collect();
        }

        return view('dashboard.tasks.edit', compact('task', 'cases', 'projects', 'lawyers'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeAccess($task);

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

        $user = Auth::user();
        $data = $request->except('assigned_to');

        if ($user->role === 'admin') {
            $data['user_id'] = $request->filled('assigned_to')
                ? $request->assigned_to
                : $user->id;
        }

        $task->update($data);

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorizeAccess($task);

        $task->delete();

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Prevents cross-organization access
     */
    private function authorizeAccess(Task $task)
    {
        $user = Auth::user();

        if ($task->organization_id !== $user->organization_id) {
            abort(403, 'Unauthorized access to this task.');
        }
    }
}
