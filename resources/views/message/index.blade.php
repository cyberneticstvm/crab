@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Message Register</h3>
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
                            <div class="col-sm-6">
                                <h5>Message Register</h5>
                            </div>
                            <div class="col-sm-6 text-end"><a href="{{ route('message.create') }}" class="btn btn-primary">Create</a></div>
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
                                        <th>Send</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $key => $message)
                                    <tr>
                                        <td>{{ $message->created_at->format('d.M.Y')}}</td>
                                        <td>{{ $message->title }}</td>
                                        <td class="text-center"><a href="{{ route('wa.message.preview', encrypt($message->id)) }}" target="_blank">Preview</a></td>
                                        <th class="text-center"><a href="{{ route('wa.message', encrypt($message->id)) }}" class=""><i class="fa fa-whatsapp fa-lg text-success"></i></a></th>
                                        <td class="text-center">{!! $message->delStatus() !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('message.edit', encrypt($message->id)) }}"><i class="fa fa-pencil fa-lg text-warning"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('message.delete', encrypt($message->id)) }}" class="dlt"><i class="fa fa-trash fa-lg text-danger"></i></a>
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
@endsection