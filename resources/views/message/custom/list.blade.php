@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Sent Messages</h3>
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
                                <h5>Sent Messages</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>Created Date</th>
                                        <th>Sent to</th>
                                        <th>Mobile</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $key => $message)
                                    <tr>
                                        <td>{{ $message->created_at->format('d.M.Y') }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->phone_code.$message->mobile }}</td>
                                        <td class="text-center"><a href="{{ route('wa.message.preview', ['id' => encrypt($message->id), 'type' => 'sent']) }}" target="_blank">View</a></td>
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