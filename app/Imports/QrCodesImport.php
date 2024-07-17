<?php

namespace App\Imports;

use App\Models\QrCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;

class QrCodesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $serialNumber = $row['serial_number'];
        $modelNumber = $row['model_number'];
        $qrCodePath = 'storage/qrcodes/' . $serialNumber . '.png';

        // QRCodeGenerator::format('png')
        //     ->size(300)
        //     ->generate("Serial Number:\n$serialNumber\n\nModel Number:\n$modelNumber", public_path($qrCodePath));

        // return new QrCode([
        //     'serial_number' => $serialNumber,
        //     'model_number' => $modelNumber,
        //     'qr_code' => $qrCodePath,
        // ]);

        try {
            // Check if the serial number already exists
            $existingQrCode = QrCode::where('serial_number', $serialNumber)->first();

            if ($existingQrCode) {
                // Handle error: Serial number already exists
                throw new \Exception("Serial Number '$serialNumber' already exists.");
            }

            // Generate QR code
            QRCodeGenerator::format('png')
                ->size(500)
                ->generate("Serial Number:\n$serialNumber\n\nModel Number:\n$modelNumber", public_path($qrCodePath));

            // Create and return new QrCode instance
            return new QrCode([
                'serial_number' => $serialNumber,
                'model_number' => $modelNumber,
                'qr_code' => $qrCodePath,
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            // For now, re-throw the exception to propagate it
            throw $e;
        }
    }
}