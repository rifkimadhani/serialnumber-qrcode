<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    // Fetch client data
    public function getClientsData()
    {
        $clients = Client::select(['id', 'client_id', 'name', 'address', 'device_type', 'total_device', 'web_app_version', 'mobile_app_version']);

        return DataTables::of($clients)
            ->addColumn('action', function ($client) {
                return '
                    <form action="'.route('clients.destroy', $client->id).'" method="POST">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <a href="'.route('clients.edit', $client->id).'" class="waves-effect waves-light btn-flat">Edit</a>
                        <button type="submit" class="waves-effect waves-teal btn-flat" style="color: #FF595E;">
                            <i class="material-icons" style="font-size: 20px">delete</i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'device_type' => 'required|string|max:255',
            'total_device' => 'required|integer',
            'web_app_version' => 'nullable|string|max:255',
            'mobile_app_version' => 'nullable|string|max:255',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'device_type' => 'required|string|max:255',
            'total_device' => 'required|integer',
            'web_app_version' => 'nullable|string|max:255',
            'mobile_app_version' => 'nullable|string|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}