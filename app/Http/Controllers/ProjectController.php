<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($response = $this->checkIzin('access_project')) {
            return $response;
        }

        if ($request->ajax()) {
            $data = Project::with('client');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('client', fn($row) => $row->client->fullname ?? '-')
                ->addColumn('status', fn($row) => ucfirst($row->status))
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="btn-group" role="group">';

                    if (Auth()->user()->role->edit_project) {
                        $editUrl = route('projects.edit', $row->id);
                        $buttons .= '<a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>';
                    }

                    if (Auth()->user()->role->delete_project) {
                        $deleteUrl = route('projects.destroy', $row->id);
                        $buttons .= '
                            <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Delete this project?\')" style="display:inline-block;">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        ';
                    }

                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('projects.index');
    }

    public function create()
    {
        if ($response = $this->checkIzin('create_project')) {
            return $response;
        }

        $clients = Client::all();
        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        if ($response = $this->checkIzin('create_project')) {
            return $response;
        }

        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'repo_url'      => 'required|string|max:255',
            'demo_url'      => 'required|string|max:255',
            'production_url'=> 'required|string|max:255',
            'deadline'      => 'nullable|date',
            'total'         => 'nullable|numeric',
            'duration'      => 'nullable|numeric',
            'start'         => 'nullable|date',
            'finish'        => 'nullable|date',
            'progress'      => 'numeric|min:0|max:100',
            'status'        => 'required|in:proposal,negotiation,deal,development,release',
        ]);

        Project::create($request->all());

        ActivityLog::log(Auth()->user()->id, "Create project {$request->title}.");

        return redirect()->route('projects.index')->with('success', 'Project has been created.');
    }

    public function edit(Project $project)
    {
        if ($response = $this->checkIzin('edit_project')) {
            return $response;
        }

        $clients = Client::all();

        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        if ($response = $this->checkIzin('edit_project')) {
            return $response;
        }

        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'repo_url'      => 'required|string|max:255',
            'demo_url'      => 'required|string|max:255',
            'production_url'=> 'required|string|max:255',
            'deadline'      => 'nullable|date',
            'total'         => 'nullable|numeric',
            'duration'      => 'nullable|numeric',
            'start'         => 'nullable|date',
            'finish'        => 'nullable|date',
            'progress'      => 'numeric|min:0|max:100',
            'status'        => 'required|in:proposal,negotiation,deal,development,release',
        ]);

        $project->update($request->all());

        ActivityLog::log(Auth()->user()->id, "Update project {$request->title}.");

        return redirect()->route('projects.index')->with('success', 'Project has been updated.');
    }

    public function destroy(Project $project)
    {
        if ($response = $this->checkIzin('delete_project')) {
            return $response;
        }

        ActivityLog::log(Auth()->user()->id, "Delete project {$project->title}.");

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project has been deleted.');
    }
}
