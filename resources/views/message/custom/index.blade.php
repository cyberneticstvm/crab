@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Message Register (Custom)</h3>
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
                        <div class="row">
                            <div class="col-sm-10">
                                <h5>Message Register (Custom)</h5>
                            </div>
                            <div class="col-sm-2 text-end dropdown-basic">
                                <div class="dropdown text-start">
                                    <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Create <span><i class="icofont icofont-arrow-down"></i></span></button>
                                    <div class="dropdown-content"><a href="{{ route('message.create', 'regular') }}" data-bs-original-title="" title="">Regular Message</a><a href="{{ route('message.create', 'custom') }}" data-bs-original-title="" title="">Custom Message</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>Created Date</th>
                                        <th>Title</th>
                                        <th>Preview</th>
                                        <th>Custom</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $key => $message)
                                    <tr>
                                        <td>{{ $message->created_at->format('d.M.Y')}}</td>
                                        <td>{{ $message->title }}</td>
                                        <td class="text-center"><a href="{{ route('wa.message.preview', ['id' => encrypt($message->id), 'type' => 'custom']) }}" target="_blank">Preview {{ $message->id }}</a></td>
                                        <td class="text-center"><a href="javascript:void(0)" data-mid="{{ $message->id }}" class="sendCustomMessage" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-send fa-lg text-primary"></i></a></td>
                                        <td class="text-center">{!! $message->delStatus() !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('message.edit', encrypt($message->id)) }}"><i class="fa fa-pencil fa-lg text-warning"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('message.delete', ['id' => encrypt($message->id), 'type' => $message->type]) }}" class="dlt"><i class="fa fa-trash fa-lg text-danger"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{ html()->form('post')->route('custom.message.save')->class('theme-form')->open() }}
            <div class="modal-header">
                <h5 class="modal-title">Send Custom Message</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="mid" id="mid" value="" />
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label class="col-form-label pt-0 req" for="donor">Receiver Name</label>
                        {{ html()->text('name', old('name'))->class('form-control')->placeholder('Name')->required() }}
                        @error('name')
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label pt-0 req" for="contributor">Country Code</label>
                        {{ html()->select('phone_code', $pcodes, '91')->class('form-control js-example-basic-single')->placeholder('Select')->required() }}
                        @error('phone_code')
                        <small class="text-danger">{{ $errors->first('phone_code') }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-8">
                        <label class="col-form-label pt-0 req" for="mobile">Mobile Number</label>
                        {{ html()->text('mobile', old('mobile'))->class('form-control')->maxlength(15)->placeholder('0123456789')->required() }}
                        @error('mobile')
                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-submit btn-primary" type="submit">Send <i class="fa fa-send"></i></button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@endsection