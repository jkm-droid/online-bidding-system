@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">All Products</li>
        </ol>
    </div>

    @if(count($products) > 0)

        @include('admin.partials.product-table')

    @else
        <p class="text-center text-danger">No recent products were found</p>
    @endif

@endsection
