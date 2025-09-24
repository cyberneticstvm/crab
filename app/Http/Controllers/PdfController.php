<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    function contributionReceipt(string $id)
    {
        $donation = Contribution::findOrFail(decrypt($id));
        $pdf = Pdf::loadView('pdfs.contribution-receipt', compact('donation'));
        return $pdf->stream('receipt' . '.pdf');
    }
}
