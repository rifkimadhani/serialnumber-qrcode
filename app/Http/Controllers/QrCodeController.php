<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QrCodesImport;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use App\Jobs\GeneratePdfJob;
use \PDF;

class QrCodeController extends Controller
{
    public function index()
    {
        $qrCodes = QrCode::all();
        return view('qr_codes.index', compact('qrCodes'));
    }

    // show data
    public function getQrCodesData()
    {
        $qrCodes = QrCode::select(['id', 'serial_number', 'model_number', 'qr_code', 'updated_at']);

        return DataTables::of($qrCodes)
            ->addColumn('select', function ($qrCode) {
                return '
                    <form>
                        <label>
                            <input type="checkbox" name="selectedQRCodes[]" value="'.$qrCode->id.'"/>
                            <span></span>
                        </label>
                    </form>
                ';
            })
            ->addColumn('qr_code', function ($qrCode) {
                if ($qrCode->qr_code) {
                    return '<img class="materialboxed" loading="lazy" src="'.asset($qrCode->qr_code).'">';
                } else {
                    return '<span>generating in background</span>';
                }
            })
            ->addColumn('action', function ($qrCode) {
                return '
                    <form action="'.route('delete').'" method="POST">
                        '.csrf_field().'
                        <input type="hidden" name="selectedQRCodes[]" value="'.$qrCode->id.'">
                        <button type="submit" class="waves-effect waves-teal btn-flat" style="color: #FF595E;">
                            <i class="material-icons" style="font-size: 20px">delete</i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['select', 'qr_code', 'action'])
            ->make(true);
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        try {
            $cacheKey = 'qr_code_progress';
            Cache::put($cacheKey, 0);
            $totalRecords = Excel::toArray(new QrCodesImport($cacheKey), $request->file('file'))[0];
            $total = count($totalRecords);
            Cache::put('qr_code_total', $total);

            Excel::import(new QrCodesImport($cacheKey), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }

        return redirect('/')->with('success', 'Data imported successfully. Generating QR Codes...');
    }

    // show progress
    public function getProgress()
    {
        $progress = Cache::get('qr_code_progress', 0);
        $total = Cache::get('qr_code_total', 1); // avoid division by 0
        $percentage = ($progress / $total) * 100;
        return response()->json(['progress' => $percentage]);
    }

    public function downloadPdf()
    {
        // ini_set('memory_limit', '512M');
        // ini_set('max_execution_time', '300');


        // $qrCodes = QrCode::all();
        // $pdf = PDF::loadView('qr_codes.pdf', compact('qrCodes'));

        // return $pdf->download('qr_codes.pdf');


        $fileName = 'qr-codes_' . date('Ymd_His') . '.pdf';
        GeneratePdfJob::dispatch($fileName);

        // check if the file exists and return an appropriate response
        $path = storage_path('storage/pdfs/' . $fileName);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return redirect('/')->with('success', 'PDF generation in progress. You will be notified once it is ready.');
        }
    }

    public function downloadSelectedPdf(Request $request)
    {
        $ids = $request->query('ids');
        if (!$ids) {
            return redirect('/')->with('error', 'No QR codes selected for download.');
        }

        $qrCodeIds = explode(',', $ids);
        $qrCodes = QrCode::whereIn('id', $qrCodeIds)->get();

        if ($qrCodes->isEmpty()) {
            return redirect('/')->with('error', 'No QR codes found for the selected IDs.');
        }

        $pdf = PDF::loadView('qr_codes.pdf', compact('qrCodes'));
        $fileName = 'selected_qr-codes_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    public function downloadPdfByRange(Request $request)
    {
        $request->validate([
            'start_serial' => 'required|string',
            'end_serial' => 'required|string',
        ]);

        $startSerial = $request->input('start_serial');
        $endSerial = $request->input('end_serial');
        $fileName = 'qr-codes_' . $startSerial . '__'. $endSerial .'.pdf';

        // Check if the range exceeds 500
        $count = QrCode::whereBetween('serial_number', [$startSerial, $endSerial])->count();
        if ($count > 500) {
            return redirect()->back()->with('error', 'The range exceeds 500 QR codes.');
        }

        $qrCodes = QrCode::whereBetween('serial_number', [$startSerial, $endSerial])->get();
        $pdf = PDF::loadView('qr_codes.pdf', compact('qrCodes'));

        return $pdf->download($fileName);
    }

    // preview pdf file
    public function previewPdf($startSerial, $endSerial){
        $qrCodes = QrCode::whereBetween('serial_number', [$startSerial, $endSerial])->get();
        return view('qr_codes.preview-pdf', compact('qrCodes'));
    }

    public function delete(Request $request){
        $ids = $request->input('selectedQRCodes');

        // Fetch the QR code file paths before deletion
        $qrCodes = QrCode::whereIn('id', $ids)->get();

        QrCode::whereIn('id', $ids)->delete();

        // Loop through each QR code and delete the corresponding file
        foreach ($qrCodes as $qrCode) {
            $filePath = public_path($qrCode->qr_code);

            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file from the directory
            }
        }

        return redirect()->back()->with('success', 'Selected QR codes deleted successfully.');
    }

    public function deleteSelected(Request $request) {
        $ids = $request->input('selectedQRCodes');

        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'No QR codes selected for deletion.']);
        }

        // Fetch the QR code file paths before deletion
        $qrCodes = QrCode::whereIn('id', $ids)->get();

        QrCode::whereIn('id', $ids)->delete();

        // Loop through each QR code and delete the corresponding file
        foreach ($qrCodes as $qrCode) {
            $filePath = public_path($qrCode->qr_code);

            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file from the directory
            }
        }

        return response()->json(['success' => true, 'message' => 'Selected QR codes deleted successfully.']);
    }

}