<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($response = $this->checkIzin('access_client')) {
            return $response;
        }

        if ($request->ajax()) {
            $data = Client::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="btn-group" role="group">';
                    if (Auth()->user()->role->edit_client) {
                        $editUrl = route('clients.edit', $row->id);
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>';
                    }
                    if (Auth()->user()->role->delete_client) {
                        $deleteUrl = route('clients.destroy', $row->id);
                        $buttons .= '
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Delete this data?\')" style="display:inline-block;">
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

        return view('clients.index');
    }

    public function create()
    {
        if ($response = $this->checkIzin('create_client')) {
            return $response;
        }

        return view('clients.create');
    }

    public function store(Request $request)
    {
        if ($response = $this->checkIzin('create_client')) {
            return $response;
        }

        $request->validate([
            'prefix'        => 'required|string|max:50',
            'fullname'      => 'required|string|max:255',
            'nickname'      => 'required|string|max:255',
            'phone'         => 'required|string|max:50',
            'email'         => 'nullable|email|max:255',
            'organization'  => 'required|string|max:255',
            'role'          => 'required|string|max:255',
            'birthday'      => 'nullable|date',
            'id_number'     => 'nullable|string|max:100',
        ]);

        Client::create($request->all());

        ActivityLog::log(Auth()->user()->id, "Create client {$request->name}.");

        return redirect()->route('clients.index')->with('success', 'Client has been created.');
    }

    public function edit(Client $client)
    {
        if ($response = $this->checkIzin('edit_client')) {
            return $response;
        }

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        if ($response = $this->checkIzin('edit_client')) {
            return $response;
        }

        $request->validate([
            'prefix'        => 'required|string|max:50',
            'fullname'      => 'required|string|max:255',
            'nickname'      => 'required|string|max:255',
            'phone'         => 'required|string|max:50',
            'email'         => 'nullable|email|max:255',
            'organization'  => 'required|string|max:255',
            'role'          => 'required|string|max:255',
            'birthday'      => 'nullable|date',
            'id_number'     => 'nullable|string|max:100',
        ]);

        $client->update($request->all());

        ActivityLog::log(Auth()->user()->id, "Update client {$request->name}.");

        return redirect()->route('clients.index')->with('success', 'Client has been updated.');
    }

    public function destroy(Client $client)
    {
        if ($response = $this->checkIzin('delete_client')) {
            return $response;
        }

        $old_data = Client::whereId($client->id)->get()->last();

        ActivityLog::log(Auth()->user()->id, "Delete client {$old_data->name}.");

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client has been deleted.');
    }
}
