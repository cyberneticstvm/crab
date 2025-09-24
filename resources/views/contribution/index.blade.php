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
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Donation Register</h5>
                            </div>
                            <div class="col-sm-6 text-end"><a href="{{ route('contribution.create') }}" class="btn btn-primary">Create</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Contributor Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Receipt</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($donations as $key => $donation)
                                    <tr>
                                        <td>{{ $donation->payment_date->format('d.M.Y')}}</td>
                                        <td>{{ $donation->member->name }}</td>
                                        <td>{{ $donation->member->mobile }}</td>
                                        <td>{{ $donation->member->email }}</td>
                                        <td class="text-end">{{ $donation->amount }}</td>
                                        <td>{{ $donation->pmode->name }}</td>
                                        <td class="text-center"><a href="{{ route('contribution.receipt', encrypt($donation->id)) }}" target="_blank"><i class="fa fa-file-pdf-o fa-lg text-danger"></i></a></td>
                                        <td class="text-center">{!! $donation->delStatus() !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('contribution.edit', encrypt($donation->id)) }}"><i class="fa fa-pencil fa-lg text-warning"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('contribution.delete', encrypt($donation->id)) }}" class="dlt"><i class="fa fa-trash fa-lg text-danger"></i></a>
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