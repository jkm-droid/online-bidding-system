@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('buyer.portal') }}">Dashboard</a>
                @endif
            </li>
            <li class="breadcrumb-item active" aria-current="page">Bids</li>
        </ol>
    </div>

    @if(count($bids) > 0)

        @include('admin.all-bids.partials.success-bids-table')

    @else
        <p class="text-center text-danger">No recent bids were found</p>
    @endif

@endsection
