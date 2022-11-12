<!----content body----->

<div class="row">

    <section class="col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Contributions</h6>
            </div>
            @if(count($recent_contributions) > 0)
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ref No</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_contributions as $recent_contribution)
                                <tr>
                                    <td><i class="fas fa-check-square"></i></td>
                                    <td>{{ $recent_contribution->reference_number }}</td>
                                    <td>{{ $recent_contribution->amount }}</td>
                                    <td>{{ $recent_contribution->balance }}</td>
                                    @if($recent_contribution->status == "pending")
                                        <td><span class="badge badge-danger">{{ $recent_contribution->status }}</span></td>
                                    @else
                                        <td><span class="badge badge-success">{{ $recent_contribution->status }}</span></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('buyer.contribution.mine') }}">view all</a>
                </div>
            @else
                <p class="text-center text-danger">No recent contributions were found</p>
            @endif
        </div>

    </section>

    <section class="col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Members</h6>
            </div>
            @if(count($members) > 0)
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td><i class="fas fa-check-square"></i></td>
                                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                    <td>{{ $member->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-center text-danger">No recent members were found</p>
            @endif
        </div>

    </section>

</div>
