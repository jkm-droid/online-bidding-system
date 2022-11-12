@extends('base.dashboard_portal')

@section('content')
    <!-- Page Heading -->
    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('buyer.portal') }}">Dashboard</a>
                @endif
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Contribution</li>
        </ol>
    </div>

    <div class="col-md-12">
        <form action="{{ route('buyer.contribution.update', $contribution->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Reference Number</label>
                    <input type="text" name="reference_number" class="form-control" value="{{ $contribution->reference_number }}" aria-label="Reference Number">
                    @if ($errors->has('reference_number'))
                        <div class="text-danger form-text"><small>{{ $errors->first('reference_number') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ $contribution->amount }}" aria-label="Amount">
                    @if ($errors->has('amount'))
                        <div class="text-danger form-text"><small>{{ $errors->first('amount') }}</small></div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Pay Date</label>
                    <input type="datetime-local" name="pay_date" class="form-control" value="{{ $contribution->pay_date }}" aria-label="pay_date">
                    @if ($errors->has('pay_date'))
                        <div class="text-danger form-text"><small>{{ $errors->first('pay_date') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Month</label>
                    <select class="form-select form-control" name="month" aria-label="Default select example">
                        <option disabled selected>Select month</option>
                        @if($contribution->month != null)
                            <option name="{{ $contribution->month }}" value="{{ $contribution->month }}" selected>{{ $contribution->month }}</option>
                        @endif
                        <option name="January" value="January">January</option>
                        <option name="February" value="February">February</option>
                        <option name="March" value="March">March</option>
                        <option name="April" value="April">April</option>
                        <option name="May" value="May">May</option>
                        <option name="June" value="June">June</option>
                        <option name="July" value="July">July</option>
                        <option name="August" value="August">August</option>
                        <option name="September" value="September">September</option>
                        <option name="October" value="October">October</option>
                        <option name="November" value="November">November</option>
                        <option name="December" value="December">December</option>
                    </select>
                    @if ($errors->has('month'))
                        <div class="text-danger form-text"><small>{{ $errors->first('month') }}</small></div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-secondary">Update Contribution</button>
        </form>
    </div>
@endsection
