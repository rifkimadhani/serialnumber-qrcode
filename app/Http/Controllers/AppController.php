<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use Yajra\DataTables\Facades\DataTables;

class AppController extends Controller
{
    public function index()
    {
        return view('apps.index');
    }

    public function getAppsData()
    {
        $apps = App::select(['id', 'name', 'version', 'type']);

        return DataTables::of($apps)
            ->addColumn('actions', function($apps) {
                return '
                    <a href="#" class="waves-effect waves-teal btn-flat edit-app" data-id="' . $apps->id . '" data-type="' . $apps->type . '" data-version="' . $apps->version . '" data-name="' . $apps->name . '" ><i class="material-icons" style="font-size: 20px">edit</i></a>
                        <a href="#" class="waves-effect waves-red btn-flat delete-app" data-id="' . $apps->id . '"><i class="material-icons" style="font-size: 20px;color: #FF595E;">delete</i></a>
                    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        App::create($request->all());

        return response()->json(['success' => 'App&apos;s added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $app = App::findOrFail($id);  // Find the app by ID
        $app->update($request->all());  // Update the app

        return response()->json(['success' => 'App\'s data updated successfully.']);
    }


    public function destroy($id)
    {
        $app = App::findOrFail($id);  // Find the app by ID
        $app->delete();  // Delete the app

        return response()->json(['success' => 'App deleted successfully.']);
    }


}

?>
