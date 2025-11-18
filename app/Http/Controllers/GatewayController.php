<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GatewayController extends Controller
{
    public function index(Request $request)
    {
        if ($response = $this->checkIzin('access_gateway')) {
            return $response;
        }

        if ($request->ajax()) {
            $data = Gateway::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="btn-group" role="group">';

                    if (Auth()->user()->role->edit_gateway) {
                        $editUrl = route('gateways.edit', $row->id);
                        $buttons .= '<a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>';
                    }

                    if (Auth()->user()->role->delete_gateway) {
                        $deleteUrl = route('gateways.destroy', $row->id);
                        $buttons .= '
                        <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Delete this data?\')" style="display:inline-block;">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
                    }

                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('gateways.index');
    }

    public function create()
    {
        if ($response = $this->checkIzin('create_gateway')) {
            return $response;
        }

        return view('gateways.create');
    }

    public function store(Request $request)
    {
        if ($response = $this->checkIzin('create_gateway')) {
            return $response;
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Gateway::create($request->only('name'));

        ActivityLog::log(Auth()->user()->id, "Create gateway {$request->name}.");

        return redirect()->route('gateways.index')->with('success', 'Gateway has been created.');
    }

    public function edit(Gateway $gateway)
    {
        if ($response = $this->checkIzin('edit_gateway')) {
            return $response;
        }

        return view('gateways.edit', compact('gateway'));
    }

    public function update(Request $request, Gateway $gateway)
    {
        if ($response = $this->checkIzin('edit_gateway')) {
            return $response;
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $gateway->update($request->only('name'));

        ActivityLog::log(Auth()->user()->id, "Update gateway {$request->name}.");

        return redirect()->route('gateways.index')->with('success', 'Gateway has been updated.');
    }

    public function destroy(Gateway $gateway)
    {
        if ($response = $this->checkIzin('delete_gateway')) {
            return $response;
        }

        $oldName = $gateway->name;

        $gateway->delete();

        ActivityLog::log(Auth()->user()->id, "Delete gateway {$oldName}.");

        return redirect()->route('gateways.index')->with('success', 'Gateway has been deleted.');
    }
}
