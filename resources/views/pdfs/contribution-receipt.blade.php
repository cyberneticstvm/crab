@extends("pdfs.base")
@section("pdfContent")
<div class="row">
    <div class="col text-center">
        <h1 class="title-color">CANCER REMEDY ASSISTANCE BUREAU (CRAB)</h1>
        <p class="font-big">Reg No. T 84/99</p>
        <p class="font-medium">TC 96/657(1), Near Kunjuveedu, Ittykonam, Pulayanarkotta</p>
        <p class="font-medium">Thuruvikkal PO, Thiruvananthapuram, Kerala - 695031</p>
        <p class="font-medium">Ph. 9447501437 | 9447028686 | 0471-2550355</p>
    </div>
    <div class="col text-center mt-10 mb-10">
        <h2 class="title-color">RECEIPT</h2>
    </div>
    <div class="col">
        <table class="border-0" width="100%">
            <tr>
                <td class="border-0">
                    <p class="font-medium">Receipt No. {{ $donation->id }}</p>
                </td>
                <td class="border-0">
                    <p class="font-medium text-end">Date. {{ $donation->payment_date->format('d.M.Y') }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="col">
        <p class="font-medium">Received a sum of <strong>Rs.{{ number_format($donation->amount, 2) }}/-</strong></p>
        <p class="font-medium ln-h-30">(INR Words) from Shri/Smt <strong>{{ $donation->member->name }}</strong>, Mobile Number <strong>{{ $donation->member->mobile }}</strong>, Address <strong>{{ $donation->member->address }}</strong>, PAN No. <strong>{{ $donation->member->pan_number ?? '..........................' }}</strong>, Email <strong>{{ $donation->member->email ?? '........................' }}</strong> in Cash / through Cheque or DD No <strong>{{ $donation->bank_cheque ?? '..........................' }}</strong> dated <strong>{{ $donation->payment_date->format('d.M.Y') }}</strong> drawn on Bank <strong>{{ $donation->bank_cheque ?? '..........................' }}</strong> towards donation.</p>
    </div>
    <div class="col mt-10">
        <p>Note: This donation is exempted U.S 80G of IT Act. 1961 vide Order No. ITBA/EXM/S/80G/2019-20/1026490567(1) Dt. 12-03-2020 of Commissioner of IT(Exemption) Kochi.</p>
    </div>
    <div class="font-medium col mt-10">
        <p>CRAB PAN No. AAATC4854E</p>
    </div>
    <div class="col mt-10">
        <p class="font-big"><strong class="box"><span style="font-family: DejaVu Sans, sans-serif; ">&#8377;</span>{{ number_format($donation->amount, 2) }}/-</strong></p>
    </div>
    <div class="col text-end">
        <p class="font-medium">Secretary</p>
    </div>
</div>
@endsection