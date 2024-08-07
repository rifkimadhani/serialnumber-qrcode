<?php

namespace App\Imports;

use App\Models\QrCode;
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

        // Check if the serial number already exists
        $existingQrCode = QrCode::where('serial_number', $serialNumber)->first();

        if ($existingQrCode) {
            // Handle error: Serial number already exists
            throw new \Exception("Serial Number '$serialNumber' already exists.");
        }

        // Create the new QrCode instance
        $qrCode = new QrCode([
            'serial_number' => $serialNumber,
            'model_number' => $modelNumber,
        ]);

        // Save the QrCode instance to the database
        $qrCode->save();

        // Dispatch the QR code generation job
        GenerateQrCodeJob::dispatch($qrCode, $this->cacheKey);

        return $qrCode;
    }
}