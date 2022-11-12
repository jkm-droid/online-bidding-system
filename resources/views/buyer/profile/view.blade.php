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
            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
        </ol>
    </div>

    <div class="col-md-12 text-center">
        <img class="img-profile rounded-circle" src="/profile_pictures/{{ $buyer->profile_url }}" alt="">
        <p>Username : <span class="font-weight-bold">{{ $buyer->username }}</span></p>
        <p>Name : <span class="font-weight-bold">{{ $buyer->full_name }}</span></p>
        <p>Email : <span class="font-weight-bold">{{ $buyer->email }}</span></p>
        <p>Phone Number : <span class="font-weight-bold">{{ $buyer->phone_number }}</span></p>
        <p>Status: <span class="badge badge-success">Active</span></p>
        <p><a href="{{ route('buyer.profile.edit') }}">Edit Profile</a></p>
    </div>

@endsection
