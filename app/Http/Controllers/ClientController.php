<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientApp;
use App\Models\ClientDevice;
use App\Models\Device;
use App\Models\Operation;
use App\Models\App;
use App\Models\Category;
use App\Models\ClientCategory;



use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        // $clients = Client::all();
        $clients = Client::with('devices', 'categories', 'operations')->get();
        $category = Category::all();

        return view('clients.index', compact('clients', 'category'));
    }

    public function show($id)
    {
        // Fetch the client along with their related data
        $client = Client::with(['devices', 'categories', 'apps', 'operations'])->findOrFail($id);
        $device = Device::all();
        $apps = App::all();
        $category = Category::all();

        // Return a view to display the client's details
        return view('clients.show', compact('client', 'device', 'apps', 'category'));
    }

    // Fetch client data
    // public function getClientsData()
    // {
    //     $clients = Client::select(['id', 'name', 'address', 'device_type', 'total_devices', 'web_app_version', 'mobile_app_version', 'notes']);

    //     return DataTables::of($clients)
    //         ->addColumn('action', function ($client) {
    //             return '
    //                 <form action="'.route('clients.destroy', $client->id).'" method="POST" style="display:inline;">
    //                     '.csrf_field().'
    //                     '.method_field('DELETE').'
    //                     <a href="#!" class="waves-effect waves-light btn-flat edit-client" data-id="'.$client->id.'" data-name="'.$client->name.'" data-address="'.$client->address.'" data-device_type="'.$client->device_type.'" data-total_devices="'.$client->total_devices.'" data-web_app_version="'.$client->web_app_version.'" data-mobile_app_version="'.$client->mobile_app_version.'" data-notes="'.$client->notes.'"><i class="material-icons" style="font-size: 20px">edit</i></a>
    //                     <button type="submit" class="waves-effect waves-teal btn-flat" style="color: #FF595E;">
    //                         <i class="material-icons" style="font-size: 20px">delete</i>
    //                     </button>
    //                 </form>
    //             ';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    // fetch data by AJAX search
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Filter clients by name or country using LIKE for partial matching
        $clients = Client::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('country', 'LIKE', "%{$query}%")
                    ->with('devices')
                    ->get();

        // Return the client-cards partial view with filtered clients
        return view('clients.partials.client-cards', compact('clients'))->render();
    }

    public function sortClients(Request $request)
    {
        $sortBy = $request->input('sort_by', 'name'); // Default sorting by name

        $clients = Client::with('devices', 'categories')
                    ->when($sortBy === 'name', function($query) {
                        $query->orderBy('name', 'asc');
                    })
                    ->when($sortBy === 'status', function($query) {
                        $query->orderBy('status', 'asc');
                    })
                    ->when($sortBy === 'country', function($query) {
                        $query->orderBy('country', 'asc');
                    })
                    ->when($sortBy === 'devices', function($query) {
                        // Sort by total devices (you may need to adjust this based on your relationship structure)
                        $query->withCount('devices')->orderBy('devices_count', 'desc');
                    })
                    ->get();

        return view('clients.partials.client-cards', compact('clients'))->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'project' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // store to clients
        $client = Client::create($request->only([
            'name', 'project', 'status', 'country', 'address', 'pic_name', 'pic_contact', 'notes'
        ]));

        // store client category in client_categories table
        ClientCategory::create([
            'client_id' => $client->id,
            'category_id' => $request->category_id,
        ]);


        return response()->json(['success' => 'New client added successfully.']);
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'pic_contact' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // update clients table
        $client->update($request->only([
            'name', 'project', 'status', 'country', 'address', 'pic_name', 'pic_contact', 'notes'
        ]));

        // update client_categories table
        $clientCategory = ClientCategory::where('client_id', $client->id)->first();
        if ($clientCategory) {
            $clientCategory->update(['category_id' => $request->category_id]);
        } else {
            ClientCategory::create([
                'client_id' => $client->id,
                'category_id' => $request->category_id,
            ]);
        }

        return response()->json(['success' => 'Client&apos;s data updated successfully.']);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['success' => 'Client deleted successfully.']);
    }


    // operation
    public function operationsData($clientId)
    {
        $operations = Operation::where('client_id', $clientId)->with('device')->get();

        return DataTables::of($operations)
            ->addColumn('actions', function ($operation) {
                return '
                    <a href="#" class="waves-effect waves-teal btn-flat edit-operation" data-id="' . $operation->id . '" data-type="' . $operation->type . '" data-device_id="' . $operation->device_id . '" data-device_total="' . $operation->device_total . '" data-date="' . $operation->date . '"><i class="material-icons" style="font-size: 20px">edit</i></a>
                    <a href="#" class="waves-effect waves-red btn-flat delete-operation" data-id="' . $operation->id . '"><i class="material-icons" style="font-size: 20px;color: #FF595E;">delete</i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function storeOperation(Request $request, $clientId)
    {
        $request->validate([
            'type' => 'required|string|in:deliver,returns',
            'device_id' => 'required|exists:devices,id',
            'device_total' => 'required|integer',
            'date' => 'required|date',
        ]);

        Operation::create([
            'client_id' => $clientId,
            'type' => $request->type,
            'device_id' => $request->device_id,
            'device_total' => $request->device_total,
            'date' => $request->date,
        ]);

        // also insert into client_devices
        $clientDeviceExists = ClientDevice::where('client_id', $clientId)
                                        ->where('device_id', $request->device_id)
                                        ->exists();
        if (!$clientDeviceExists) {
            ClientDevice::create([
                'client_id' => $clientId,
                'device_id' => $request->device_id,
            ]);
        }

        return response()->json(['success' => 'Operation added successfully.']);
    }

    public function updateOperation(Request $request, $clientId, $operationId)
    {
        $request->validate([
            'type' => 'required|string|in:deliver,returns',
            'device_id' => 'required|exists:devices,id',
            'device_total' => 'required|integer',
            'date' => 'required|date',
        ]);

        // update operations table
        $operation = Operation::where('client_id', $clientId)->findOrFail($operationId);
        $operation->update($request->all());

        // check client_devices table
        $clientDeviceExists = ClientDevice::where('client_id', $clientId)
                                        ->where('device_id', $request->device_id)
                                        ->exists();
        if (!$clientDeviceExists) {
            ClientDevice::create([
                'client_id' => $clientId,
                'device_id' => $request->device_id,
            ]);
        }

        return response()->json(['success' => 'Operation updated successfully.']);
    }

    public function destroyOperation($clientId, $operationId)
    {
        // Find the operation by client and operation ID and delete it
        $operation = Operation::where('client_id', $clientId)->findOrFail($operationId);
        $deviceId = $operation->device_id;
        $operation->delete();

        // delete on client_device table
        $operationExists = Operation::where('client_id', $clientId)
                                    ->where('device_id', $deviceId)
                                    ->exists();

        if (!$operationExists) {
            ClientDevice::where('client_id', $clientId)
                        ->where('device_id', $deviceId)
                        ->delete();
        }

        return response()->json(['success' => 'Operation deleted successfully.']);
    }


    public function storeClientApp(Request $request, $clientId)
    {
        $request->validate([
            'app_id' => 'required|exists:apps,id',
        ]);

        // Ensure the client-app relationship does not already exist
        $clientAppExists = ClientApp::where('client_id', $clientId)
                                    ->where('app_id', $request->app_id)
                                    ->exists();

        if (!$clientAppExists) {
            ClientApp::create([
                'client_id' => $clientId,
                'app_id' => $request->app_id,
            ]);

            return response()->json(['success' => 'App added to client successfully.']);
        }

        return response()->json(['error' => 'App is already added to this client.'], 400);
    }


}
