<?php

namespace App\Jobs;

use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GenerateQrCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $qrCode;
    protected $cacheKey;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(QrCode $qrCode, $cacheKey)
    {
        $this->qrCode = $qrCode;
        $this->cacheKey = $cacheKey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serialNumber = $this->qrCode->serial_number;
        $modelNumber = $this->qrCode->model_number;
        $qrCodePath = '/storage/qrcodes/' . $serialNumber . '.png';

        // Generate QR code
        QRCodeGenerator::format('png')
            ->size(500)
            ->generate("QUOKKA BOX\n\nSerial Number:\n$serialNumber\n==============\nModel Number:\n$modelNumber\n==============", public_path($qrCodePath));

        // Update the QR code path in the database
        $this->qrCode->update(['qr_code' => $qrCodePath]);

        // Update progress
        Cache::increment($this->cacheKey);
    }
}