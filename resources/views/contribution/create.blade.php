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
                    {{ html()->form('post')->route('contribution.save')->class('theme-form')->open() }}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label class="col-form-label pt-0 req" for="date">Date</label>
                                    {{ html()->date('payment_date', old('payment_date') ?? date('Y-m-d'))->class('form-control') }}
                                    @error('payment_date')
                                    <small class="text-danger">{{ $errors->first('payment_date') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label pt-0 req" for="contributor">Contributor Name</label>
                                    {{ html()->select('member_id', $members, null)->class('form-control js-example-basic-single')->placeholder('Select') }}
                                    @error('member_id')
                                    <small class="text-danger">{{ $errors->first('member_id') }}</small>
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