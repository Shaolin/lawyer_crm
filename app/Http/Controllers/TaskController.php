<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->role === 'admin'
            ? Task::with('legalCase', 'user')->latest()->get()
            : Task::with('legalCase', 'user')->where('user_id', Auth::id())->latest()->get();

        return view('dashboard.tasks.index', compact('tasks'));
    }

    public function create()
    {
        // Lawyers can only attach tasks to cases they own
        $cases = Auth::user()->role === 'admin'
            ? LegalCase::all()
            : LegalCase::where('user_id', Auth::id())->get();

        return view('dashboard.tasks.create', compact('cases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pending,completed,cancelled',
            'type'        => 'required|string',
            'legal_case_id' => 'nullable|exists:legal_cases,id',
        ]);

        Task::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'due_date'      => $request->due_date,
            'status'        => $request->status,
            'type'          => $request->type,
            'user_id'       => Auth::id(),
            'legal_case_id' => $request->legal_case_id,
            'organization_id' => Auth::user()->organization_id ?? null,
        ]);

        return redirect()->route('dashboard.tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $cases = Auth::user()->role === 'admin'
            ? LegalCase::all()
            : LegalCase::where('user_id', Auth::id())->get();

        return view('dashboard.tasks.edit', compact('task', 'cases'));
    }
    

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pending,completed,cancelled',
            'type'        => 'required|string',
            'legal_case_id' => 'nullable|exists:legal_cases,id',
        ]);

        $task->update($request->all());

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
    // Eager load related user and case
    $task->load(['user', 'legalCase']);

    return view('dashboard.tasks.show', compact('task'));
}

}
