<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QrCodesImport;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use \PDF;

class QrCodeController extends Controller
{
    public function index()
    {
        $qrCodes = QrCode::all();
        return view('qr_codes.index', compact('qrCodes'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Excel::import(new QrCodesImport, $request->file('file'));

        try {
            Excel::import(new QrCodesImport, $request->file('file'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }

        return redirect('/')->with('success', 'QR codes generated successfully.');
    }

    public function downloadPdf()
    {
        $qrCodes = QrCode::all();
        $pdf = PDF::loadView('qr_codes.pdf', compact('qrCodes'));

        return $pdf->download('qr_codes.pdf');
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

        return $pdf->download('selected_qr_codes.pdf');
    }

    public function delete(Request $request){
        $ids = $request->input('selectedQRCodes');
        QrCode::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Selected QR codes deleted successfully.');
    }

}