@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Donation</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Donation Create</h5>
                    </div>
                    {{ html()->form('post')->route('donation.save')->class('theme-form')->open() }}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label class="col-form-label pt-0 req" for="date">Date</label>
                                    {{ html()->date('donation_date', old('donation_date') ?? date('Y-m-d'))->class('form-control') }}
                                    @error('donation_date')
                                    <small class="text-danger">{{ $errors->first('donation_date') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label pt-0 req" for="donor">Donor Name</label>
                                    {{ html()->text('name', old('name'))->class('form-control')->placeholder('Donor Name') }}
                                    @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0 req" for="mobile">Mobile Number</label>
                                    {{ html()->text('mobile', old('mobile'))->class('form-control')->maxlength(10)->placeholder('0123456789') }}
                                    @error('mobile')
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label pt-0" for="email">Email</label>
                                    {{ html()->email('email', old('email'))->class('form-control')->placeholder('hello@example.com') }}
                                    @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0" for="pan">Pancard</label>
                                    {{ html()->text('pan_number', old('pan_number'))->class('form-control')->maxlength(10)->placeholder('XXXXXXXXXX') }}
                                    @error('pan_number')
                                    <small class="text-danger">{{ $errors->first('pan_number') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label pt-0 req" for="address">Address</label>
                                    {{ html()->text('address', old('address'))->class('form-control')->placeholder('Address') }}
                                    @error('address')
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0 req" for="pmode">Payment Mode</label>
                                    {{ html()->select('payment_mode', $pmodes, old('payment_mode'))->class('form-control')->placeholder('Select') }}
                                    @error('payment_mode')
                                    <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0 req" for="amount">Amount</label>
                                    {{ html()->number('amount', old('amount'))->class('form-control')->placeholder('0.00') }}
                                    @error('amount')
                                    <small class="text-danger">{{ $errors->first('amount') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label pt-0" for="bank_cheque">Bank Name / Cheque Number if applicable</label>
                                    {{ html()->text('bank_cheque', old('bank_cheque'))->class('form-control')->placeholder('xxxxxxxxxx') }}
                                    @error('bank_cheque')
                                    <small class="text-danger">{{ $errors->first('bank_cheque') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label pt-0" for="remarks">Remarks</label>
                                    {{ html()->text('remarks', old('remarks'))->class('form-control')->placeholder('Remarks') }}
                                    @error('remarks')
                                    <small class="text-danger">{{ $errors->first('remarks') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-submit btn-primary" type="submit">Save</button>
                            <a class="btn btn-secondary" onclick="window.history.back()">Cancel</a>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection