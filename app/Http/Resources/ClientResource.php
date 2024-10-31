<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->categories ? [
                'id' => $this->categories->first()->id,
                'name' => $this->categories->first()->name,
            ] : null,
            'project' => $this -> project,
            'status' => $this -> status,
            'country' => $this -> country,
            'address' => $this -> address,
            'pic_name' => $this -> pic_name,
            'pic_contact' => $this -> pic_contact,
            'notes' => $this -> notes,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),

            // 'category' => $this->categories->map(function ($category) {
            //     return [
            //         'id' => $category -> id,
            //         'name' => $category -> name,
            //     ];
            // }),

            'devices' => $this->devices->map(function ($device) {
                return [
                    'id' => $device -> id,
                    'name' => $device -> name,
                    'model' => $device -> model
                ];
            }),

            'apps' => $this->apps->map(function ($app) {
                return [
                    'id' => $app -> id,
                    'name' => $app -> name,
                    'type' => $app -> type,
                    'version' => $app -> version,
                ];
            }),

            'total_devices' => $this->totalDevices(),
            'device_summary' => $this->totalDevicesPerDevice(),

            'operations' => $this->operations->map(function ($operation) {
                return [
                    'id' => $operation -> id,
                    'type' => $operation -> type,
                    'device_id' => $operation -> device_id,
                    'device_total' => $operation -> device_total,
                    'date' => $operation -> date,
                ];
            }),

        ];
    }
}