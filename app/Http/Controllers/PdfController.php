<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    function donationReceipt(string $id)
    {
        $donation = Donation::findOrFail(decrypt($id));
        $pdf = Pdf::loadView('pdfs.donation-receipt', compact('donation'));
        return $pdf->stream('receipt' . '.pdf');
    }
}
