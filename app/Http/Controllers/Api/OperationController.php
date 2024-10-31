<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;

class OperationController extends Controller
{
    public function index()
    {
        return response()->json(Operation::all(), 200);
    }

    public function show($id)
    {
        $operation = Operation::find($id);

        if (!$operation) {
            return response()->json(['error' => 'Operation not found'], 404);
        }

        return response()->json($operation, 200);
    }

    public function store(Request $request)
    {
        $operation = new Operation();
        $operation->client_id = $request->client_id;
        $operation->type = $request->type;
        $operation->device_id = $request->device_id;
        $operation->device_total = $request->device_total;
        $operation->date = $request->date;
        $operation->save();

        return response()->json(['message' => 'Operation created successfully'], 201);
    }
}