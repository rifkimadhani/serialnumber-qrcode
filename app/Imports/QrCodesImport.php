<?php

namespace App\Imports;

use App\Models\QrCode;
use App\Models\Client;
use App\Models\Device;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Jobs\GenerateQrCodeJob;
use Illuminate\Support\Facades\Cache;

class QrCodesImport implements ToModel, WithHeadingRow
{
    protected $cacheKey;

    public function __construct($cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    public function model(array $row)
    {
        $serialNumber = $row['serial_number'];
        $modelNumber = $row['model_number'];
        $clientName = $row['client_name'];

        // Check if the serial number already exists
        $existingQrCode = QrCode::where('serial_number', $serialNumber)->first();

        if ($existingQrCode) {
            // Handle error: Serial number already exists
            throw new \Exception("Serial Number '$serialNumber' already exists.");
        }

        // get client_id based on client_name
        $clientId = Client::where('name', $clientName)->pluck('id')->first();

        if (!$clientId) {
            // Handle error if client is not found
            throw new \Exception("Client with name '$clientName' not found.");
        }

        // get device_id based on model_number
        $deviceId = Device::where('model', $modelNumber)->pluck('id')->first();

        if (!$deviceId) {
            // Handle error if client is not found
            throw new \Exception("Device with Model Number '$modelNumber' not found.");
        }

        // Create the new QrCode instance
        $qrCode = new QrCode([
            'serial_number' => $serialNumber,
            'model_number' => $modelNumber,
            'client_id' => $clientId,
            'device_id' => $deviceId,
        ]);

        // Save the QrCode instance to the database
        $qrCode->save();

        // Dispatch the QR code generation job
        GenerateQrCodeJob::dispatch($qrCode, $this->cacheKey);

        return $qrCode;
    }
}