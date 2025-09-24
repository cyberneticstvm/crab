@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{ ucfirst($member->type) }}</h3>
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
                        <h5>{{ ucfirst($member->type) }} Create</h5>
                    </div>
                    {{ html()->form('post')->route('member.update', encrypt($member->id))->class('theme-form')->open() }}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label class="col-form-label pt-0 req" for="donor">Name</label>
                                    {{ html()->text('name', $member->name)->class('form-control')->placeholder('Name') }}
                                    @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0 req" for="mobile">Mobile Number</label>
                                    {{ html()->text('mobile', $member->mobile)->class('form-control')->maxlength(10)->placeholder('0123456789') }}
                                    @error('mobile')
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label pt-0" for="email">Email</label>
                                    {{ html()->email('email', $member->email)->class('form-control')->placeholder('hello@example.com') }}
                                    @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="col-form-label pt-0" for="pan">Pancard</label>
                                    {{ html()->text('pan_number', $member->pan_number)->class('form-control')->maxlength(10)->placeholder('XXXXXXXXXX') }}
                                    @error('pan_number')
                                    <small class="text-danger">{{ $errors->first('pan_number') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label pt-0 req" for="address">Address</label>
                                    {{ html()->text('address', $member->address)->class('form-control')->placeholder('Address') }}
                                    @error('address')
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-submit btn-primary" type="submit">Update</button>
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