<?php

namespace App\Http\Controllers;

use App\Exports\DonationExport;
use App\Exports\MemberExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function exportMember($type)
    {
        return Excel::download(new MemberExport($type), 'member.xlsx');
    }

    public function exportDonation()
    {
        return Excel::download(new DonationExport(), 'donation.xlsx');
    }
}
