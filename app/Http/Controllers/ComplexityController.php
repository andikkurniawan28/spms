<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Complexity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ComplexityController extends Controller
{
    public function index(Request $request)
    {
        if ($response = $this->checkIzin('access_complexity')) {
            return $response;
        }

        if ($request->ajax()) {
            $data = Complexity::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $buttons = '<div class="btn-group" role="group">';

                    // Edit
                    if (Auth()->user()->role->edit_complexity) {
                        $editUrl = route('complexities.edit', $row->id);
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>';
                    }

                    // Delete
                    if (Auth()->user()->role->delete_complexity) {
                        $deleteUrl = route('complexities.destroy', $row->id);
                        $buttons .= '
                            <form action="' . $deleteUrl . '" method="POST"
                                onsubmit="return confirm(\'Delete this data?\')" style="display:inline-block;">
                                ' . csrf_field() . method_field('DELETE') . '
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

        return view('complexities.index');
    }

    public function create()
    {
        if ($response = $this->checkIzin('create_complexity')) {
            return $response;
        }

        return view('complexities.create');
    }

    public function store(Request $request)
    {
        if ($response = $this->checkIzin('create_complexity')) {
            return $response;
        }

        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'default_price'    => 'required|numeric',
            'default_duration' => 'required|numeric',
        ]);

        Complexity::create($request->all());

        ActivityLog::log(Auth()->user()->id, "Create complexity {$request->title}.");

        return redirect()->route('complexities.index')->with('success', 'Complexity has been created.');
    }

    public function edit(Complexity $complexity)
    {
        if ($response = $this->checkIzin('edit_complexity')) {
            return $response;
        }

        return view('complexities.edit', compact('complexity'));
    }

    public function update(Request $request, Complexity $complexity)
    {
        if ($response = $this->checkIzin('edit_complexity')) {
            return $response;
        }

        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'default_price'    => 'required|numeric',
            'default_duration' => 'required|numeric',
        ]);

        $complexity->update($request->all());

        ActivityLog::log(Auth()->user()->id, "Update complexity {$request->title}.");

        return redirect()->route('complexities.index')->with('success', 'Complexity has been updated.');
    }

    public function destroy(Complexity $complexity)
    {
        if ($response = $this->checkIzin('delete_complexity')) {
            return $response;
        }

        $old = Complexity::whereId($complexity->id)->first();

        ActivityLog::log(Auth()->user()->id, "Delete complexity {$old->title}.");

        $complexity->delete();

        return redirect()->route('complexities.index')->with('success', 'Complexity has been deleted.');
    }
}
