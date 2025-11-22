@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Message</h3>
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
                        <h5>Message Update</h5>
                    </div>
                    {{ html()->form('post')->route('message.update', ['id' => encrypt($message->id), 'type' => $message->type])->class('theme-form')->open() }}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label pt-0" for="title">Message Title</label>
                                    {{ html()->text('title', $message->title)->class('form-control')->placeholder('Message Title') }}
                                    @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-form-label pt-0 req" for="title">Letter Head Format</label>
                                <div class="col-sm-3">
                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                        <div class="radio radio-primary">
                                            <input id="letter_head" type="radio" name="letter_head" value="1" {{ ($message->letter_head == 1) ? 'checked' : '' }}>
                                            <label class="mb-0" for="letter_head">Option<span class="digits"> 1</span></label>
                                        </div>
                                    </div>
                                    <img src="{{ asset('/assets/docs/crab-lh-bg.jpg') }}" width="25%" />
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                        <div class="radio radio-primary">
                                            <input id="letter_head1" type="radio" name="letter_head" value="2" {{ ($message->letter_head == 2) ? 'checked' : '' }}>
                                            <label class="mb-0" for="letter_head1">Option<span class="digits"> 2</span></label>
                                        </div>
                                    </div>
                                    <img src="{{ asset('/assets/docs/crab-lh-bg1.jpg') }}" width="25%" />
                                </div>
                            </div>
                            <div class="row mt-3 g-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label pt-0" for="message">Message Content</label>
                                    {{ html()->textarea('message', $message->message)->rows(10)->class('form-control')->placeholder('Message Content') }}
                                    @error('message')
                                    <small class="text-danger">{{ $errors->first('message') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <label class="col-form-label pt-0" for="message">Include Signature & Stamp</label>
                                    <input type="checkbox" name="is_signed" value="1" class="" {{ ($message->is_signed) ? 'checked' : '' }} />
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