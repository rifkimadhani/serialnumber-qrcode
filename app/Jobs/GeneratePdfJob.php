<?php

namespace App\Jobs;

use App\Models\QrCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \PDF;

class GeneratePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileName;

    /**
     * Create a new job instance.
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $qrCodes = QrCode::all();
        $pdf = PDF::loadView('qr_codes.pdf', compact('qrCodes'))->setPaper('a4', 'landscape');
        $path = storage_path('storage/pdfs/' . $this->fileName);
        $pdf->save($path);
    }
}