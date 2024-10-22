<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();

        return view('devices.index', compact('devices'));
    }

    public function getDevicesData()
    {
        $devices = Device::select(['id', 'name', 'model', 'stock']);

        return DataTables::of($devices)
            ->addColumn('actions', function($devices) {
                return '
                    <a href="#" class="waves-effect waves-teal btn-flat edit-device" data-id="' . $devices->id . '" data-name="' . $devices->name . '" data-stock="' . $devices->stock . '" data-model="' . $devices->model . '"><i class="material-icons" style="font-size: 20px">edit</i></a>
                        <a href="#" class="waves-effect waves-red btn-flat delete-device" data-id="' . $devices->id . '"><i class="material-icons" style="font-size: 20px;color: #FF595E;">delete</i></a>
                    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'stock' => 'nullable|integer',
        ]);

        Device::create($request->all());

        return response()->json(['success' => 'Device&apos;s added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'stock' => 'nullable|integer',
        ]);

        $device = Device::findOrFail($id);  // Find the device by ID
        $device->update($request->all());  // Update the device

        return response()->json(['success' => 'Device\'s data updated successfully.']);
    }


    public function destroy($id)
    {
        $device = Device::findOrFail($id);  // Find the device by ID
        $device->delete();  // Delete the device

        return response()->json(['success' => 'Device deleted successfully.']);
    }


}

?>
