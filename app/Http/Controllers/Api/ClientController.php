<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Client;
use Validator;
use App\Http\Resources\ClientResource;
use Illuminate\Http\JsonResponse;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $clients = Client::all();

        return $this->sendResponse(ClientResource::collection($clients), 'Clients retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        // $client = Client::find($id);
        $client = Client::with(['devices', 'categories', 'apps', 'operations'])->findOrFail($id);

        if (is_null($client)) {
            return $this->sendError('Client not found.');
        }

        return $this->sendResponse(new ClientResource($client), 'Client retrieved successfully.');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request): JsonResponse
    // {
    //     $input = $request->all();

    //     $validator = Validator::make($input, [
    //         'name' => 'required|string|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'project' => 'required|string|max:255',
    //         'status' => 'required|string|max:255',
    //         'country' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'pic_name' => 'nullable|string|max:255',
    //         'pic_contact' => 'nullable|string|max:255',
    //         'notes' => 'nullable|string',
    //     ]);

    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     $client = Client::create($input);

    //     return $this->sendResponse(new ClientResource($client), 'Client created successfully.');
    // }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Client $client): JsonResponse
    // {
    //     $input = $request->all();

    //     $validator = Validator::make($input, [
    //         'name' => 'required',
    //         'detail' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     $client->name = $input['name'];
    //     $client->detail = $input['detail'];
    //     $client->save();

    //     return $this->sendResponse(new ClientResource($client), 'Client updated successfully.');
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Client $client): JsonResponse
    // {
    //     $client->delete();

    //     return $this->sendResponse([], 'Client deleted successfully.');
    // }
}
