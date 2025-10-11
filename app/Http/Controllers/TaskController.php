<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\LegalCase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->role === 'admin'
            ? Task::with(['legalCase', 'project', 'user'])->latest()->get()
            : Task::with(['legalCase', 'project', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

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

        // ✅ If admin assigns a lawyer → use that ID
        // If admin leaves it empty → assign to himself
        // If lawyer creates → assign to the logged-in lawyer
        $assignedUserId = Auth::user()->role === 'admin'
            ? ($request->filled('assigned_to') ? $request->assigned_to : Auth::id())
            : Auth::id();

        Task::create([
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

        return redirect()->route('dashboard.tasks.index')->with('success', 'Task created successfully.');
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

        // ✅ Admin can reassign or take it himself
        if (Auth::user()->role === 'admin') {
            $data['user_id'] = $request->filled('assigned_to')
                ? $request->assigned_to
                : Auth::id();
        } else {
            // Lawyer cannot change assignment
            $data['user_id'] = $task->user_id;
        }

        $task->update($data);

        return redirect()->route('dashboard.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('dashboard.tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['user', 'legalCase', 'project']);
        return view('dashboard.tasks.show', compact('task'));
    }
}
