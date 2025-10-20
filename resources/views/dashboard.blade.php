@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Dashboard</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                <div class="card income-card card-secondary">
                    <div class="card-body align-items-center">
                        <div class="round-progress knob-block text-center">
                            <a class="btn btn-square btn-primary" href="{{ route('contribution.register') }}">Donation Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right second">
                <div class="card income-card card-primary">
                    <div class="card-body">
                        <div class="round-progress knob-block text-center">
                            <a class="btn btn-square btn-primary" href="{{ route('member.register', 'member') }}">Member Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right second">
                <div class="card income-card card-primary">
                    <div class="card-body">
                        <div class="round-progress knob-block text-center">
                            <a class="btn btn-square btn-primary" href="{{ route('member.register', 'contributor') }}">Well-wisher Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right second">
                <div class="card income-card card-primary">
                    <div class="card-body">
                        <div class="round-progress knob-block text-center">
                            <a class="btn btn-square btn-primary" href="{{ route('message.register') }}">Message Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5>Dashboard</h5><span>Well-wishers</span>
                            </div>
                            <div class="col-sm-2 text-end dropdown-basic">
                                <div class="dropdown text-start">
                                    <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Create <span><i class="icofont icofont-arrow-down"></i></span></button>
                                    <div class="dropdown-content"><a href="{{ route('member.create', 'member') }}" data-bs-original-title="" title="">Member</a><a href="{{ route('member.create', 'contributor') }}" data-bs-original-title="" title="">Well-wisher</a></div>
                                </div>
                            </div>
                            <div class="col-sm-2 text-start dropdown-basic">
                                <div class="dropdown text-start">
                                    <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Export <span><i class="icofont icofont-arrow-down"></i></span></button>
                                    <div class="dropdown-content"><a href="{{ route('export.member', 'all') }}" data-bs-original-title="" title=""><i class="fa fa-file-excel-o fa-success"></i>&nbsp;&nbsp;Excel</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>Member Name</th>
                                        <!--<th>Type</th>-->
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Donation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $key => $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <!--<td>{{ ($member->type == 'contributor') ? 'Well-wisher' : 'Member' }}</td>-->
                                        <td>{{ $member->mobile }} | {{ $member->country?->code }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->address }}</td>
                                        <td class="text-center"><a href="{{ route('contribution.create', encrypt($member->id)) }}">Donation</a></td>
                                        <td class="text-center">{!! $member->delStatus() !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('member.edit', encrypt($member->id)) }}"><i class="fa fa-pencil fa-lg text-warning"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('member.delete', encrypt($member->id)) }}" class="dlt"><i class="fa fa-trash fa-lg text-danger"></i></a>
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