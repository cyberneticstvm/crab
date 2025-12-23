@extends("pdfs.base")
@section("pdfContent")
<div class="row receipt">
    <div class="col text-center">
        <table class="border-0">
            <tr class="border-0">
                <td width="20%" class="border-0"><img src="./assets/docs/crab-logo.jpeg" width='100%' /></td>
                <td class="border-0" style="line-height: 10px;">
                    <h2 class="title-color">CANCER REMEDY ASSISTANCE BUREAU (CRAB)</h2>
                    <p class="font-big">Reg No. T 84/99</p>
                    <p class="font-medium">TC 96/657(1), Near Kunjuveedu, Ittykonam, Pulayanarkotta</p>
                    <p class="font-medium">Thuruvikkal PO, Thiruvananthapuram, Kerala - 695031</p>
                    <p class="font-medium">Ph. 9447501437 | 9447028686 | 0471-2550355</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="col text-center">
        <h2 class="title-color">RECEIPT</h2>
    </div>
    <div class="col">
        <table class="border-0" width="100%">
            <tr>
                <td class="border-0">
                    <div class="font-medium">Receipt No. {{ $donation->receipt_number }}</div>
                </td>
                <td class="border-0">
                    <div class="font-medium text-end">Date. {{ date('d.M.Y') }}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col">
        <p class="font-medium">Received a sum of <strong>Rs.{{ number_format($donation->amount, 2) }}/-</strong></p>
        <p class="font-medium ln-h-30"> from Shri/Smt <strong>{{ $donation->member->name }}</strong>, Mobile Number <strong>{{ $donation->member->mobile }}</strong>, Address <strong>{{ $donation->member->address }}</strong>, PAN/Aadhaar No. <strong>{{ $idno ?? '..........................' }}</strong>, Email <strong>{{ $donation->member->email ?? '........................' }}</strong> as Cash/Cheque/DD (Bank) <strong>{{ $donation->bank_cheque ?? '..........................' }}</strong> dated <strong>{{ $donation->payment_date->format('d.M.Y') }}</strong> towards donation.</p>
    </div>
    <div class="col mt-10">
        Note: This donation is exempted U.S 80G of IT Act. 1961 vide Order No. ITBA/EXM/S/80G/2019-20/1026490567(1) Dt. 12-03-2020 by Commissioner of IT(Exemption) Kochi.
    </div>
    <div class="font-medium col mt-5 text-end">
        CRAB PAN No. AAATC4854E
    </div>
    <div class="col">
        <div class="font-big mt-10" style="display: inline-block;"><strong class="box"><span style="font-family: DejaVu Sans, sans-serif; ">&#8377;</span>{{ number_format($donation->amount, 2) }}/-</strong></div>
    </div>
    <div class="font-medium text-end">
        Secretary
    </div>
</div>
@endsection