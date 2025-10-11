<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $organizationId = Auth::user()->organization_id;

        $projects = Project::where('organization_id', $organizationId)
            ->with('client')
            ->latest()
            ->paginate(10);

        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        $organizationId = Auth::user()->organization_id;
        $clients = Client::where('organization_id', $organizationId)->get();

        return view('dashboard.projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $validated['organization_id'] = Auth::user()->organization_id;
        $validated['user_id'] = Auth::id();

        Project::create($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $this->authorizeAccess($project);

        return view('dashboard.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeAccess($project);

        $clients = Client::where('organization_id', Auth::user()->organization_id)->get();

        return view('dashboard.projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeAccess($project);

        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    private function authorizeAccess(Project $project)
    {
        if ($project->organization_id !== Auth::user()->organization_id) {
            abort(403, 'Unauthorized access');
        }
    }
}
