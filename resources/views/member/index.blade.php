@extends("base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{ ucfirst($type) }}s</h3>
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
                                <h5>{{ ucfirst($type) }} Register</h5>
                            </div>
                            <div class="col-sm-6 text-end dropdown-basic">
                                <div class="dropdown text-start">
                                    <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Create <span><i class="icofont icofont-arrow-down"></i></span></button>
                                    <div class="dropdown-content"><!--<a href="{{ route('member.create', 'member') }}" data-bs-original-title="" title="">Member</a>--><a href="{{ route('member.create', $type) }}" data-bs-original-title="" title="">Contributor</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>Register Date</th>
                                        <th>Member Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $key => $member)
                                    <tr>
                                        <td>{{ $member->created_at->format('d.M.Y')}}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->mobile }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->address }}</td>
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