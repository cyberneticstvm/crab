<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MemberExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $type;
    public function __construct($type)
    {
        $this->type = $type;
    }
    public function collection()
    {
        $type = $this->type;
        $members = Member::when($type != 'all', function ($q) use ($type) {
            return $q->where('type', $type);
        })->orderBy('name')->get();
        return $members->map(function ($data, $key) {
            return [
                'slno' => $key + 1,
                'name' => $data->name,
                'dob' => $data->dob?->format('d.M.Y'),
                'mobile' => $data->mobile,
                'email' => $data->email,
                'pan' => $data->pan_number,
                'adhaar' => $data->adhaar,
                'address' => $data->address,
            ];
        });
    }

    public function headings(): array
    {
        return ['SL No', 'Member Name', 'Date of Birth', 'Contact Number', 'Email Id', 'Pancard', 'Adhaar', 'Address'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    }
}
