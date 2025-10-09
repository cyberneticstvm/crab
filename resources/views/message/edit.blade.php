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
                    {{ html()->form('post')->route('message.update', encrypt($message->id))->class('theme-form')->open() }}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label pt-0 req" for="title">Message Title</label>
                                    {{ html()->text('title', $message->title)->class('form-control')->placeholder('Message Title') }}
                                    @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <label class="col-form-label pt-0" for="message">Message Content</label>
                                    {{ html()->textarea('message', $message->message)->rows(10)->class('form-control')->placeholder('Message Content') }}
                                    @error('message')
                                    <small class="text-danger">{{ $errors->first('message') }}</small>
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