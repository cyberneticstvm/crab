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
        $idno = $donation->member->pan_number;
        if (!$idno):
            $idno = $donation->member->adhaar;
        endif;
        $pdf = Pdf::loadView('pdfs.contribution-receipt', compact('donation', 'idno'));
        return $pdf->stream('receipt' . '.pdf');
    }
}
