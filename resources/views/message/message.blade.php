@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Send Message</h3>
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
                            <div class="col-sm-12">
                                <h5>Send Message - {{ $message->title }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ html()->form('post')->route('send.wa.message', encrypt($message->id))->class('theme-form')->open() }}
                        <div class="col-md-6">
                            <div class="col-sm-12">
                                <h5>Members</h5>
                            </div>
                            <div class="col">
                                <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                    @forelse($members->where('type', 'member') as $key => $mem)
                                    <div class="checkbox checkbox-dark">
                                        <input id="inline_{{ $mem->id }}" value="{{ $mem->id }}" name="recipients[]" type="checkbox">
                                        <label for="inline_{{ $mem->id }}">{{ $mem->name }}</label>
                                    </div>
                                    @empty
                                    <div class="text-info">No records found!</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-sm-12">
                                <h5>Well-wishers</h5>
                            </div>
                            <div class="col">
                                <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                    @forelse($members->where('type', 'contributor') as $key => $mem)
                                    <div class="checkbox checkbox-dark">
                                        <input id="inline_{{ $mem->id }}" value="{{ $mem->id }}" name="recipients[]" type="checkbox">
                                        <label for="inline_{{ $mem->id }}">{{ $mem->name }}</label>
                                    </div>
                                    @empty
                                    <div class="text-danger">No records found!</div>
                                    @endforelse
                                </div>
                            </div>
                            @error('recipients')
                            <small class="text-danger">{{ $errors->first('recipients') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3 text-end">
                            <button class="btn btn-submit btn-primary" type="submit">Send Message</button>
                            <a class="btn btn-info" href="{{ route('wa.message.preview', encrypt($message->id)) }}" target="_blank">Preview</a>
                            <a class="btn btn-secondary" onclick="window.history.back()">Cancel</a>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection