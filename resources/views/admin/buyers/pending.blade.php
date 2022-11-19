@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pending Members</li>
        </ol>
    </div>

    @if(count($buyers) > 0)

        @include('admin.buyers.partials.buyers-table')

    @else
        <p class="text-center text-danger">No recent registered buyers were found</p>
    @endif

@endsection
