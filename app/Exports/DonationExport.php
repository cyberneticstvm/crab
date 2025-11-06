<?php

namespace App\Exports;

use App\Models\Contribution;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $donations = Contribution::latest()->get();
        return $donations->map(function ($data, $key) {
            return [
                'slno' => $key + 1,
                'slno' => $data->receipt_number,
                'name' => $data->member->name,
                'mobile' => $data->member->mobile,
                'email' => $data->member->email,
                'pan' => $data->member->pan_number,
                'amount' => $data->amount,
                'mode' => $data->pmode->name,
                'date' => $data->payment_date?->format('d.M.Y'),
            ];
        });
    }

    public function headings(): array
    {
        return ['SL No', 'Receipt No', 'Member Name', 'Contact Number', 'Email', 'PanCard', 'Amount', 'Payment Mode', 'Date'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
    }
}
