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
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </div>

    <div class="col-md-12">
        <form action="{{ route('buyer.profile.update', $buyer->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{$buyer->username}}">
                    @if ($errors->has('username'))
                        <div class="text-danger form-text"><small>{{ $errors->first('username') }}</small></div>
                    @endif
                </div>

                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">First Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{$buyer->full_name}}" placeholder="Full name" aria-label="Full name">
                    @if ($errors->has('full_name'))
                        <div class="text-danger form-text"><small>{{ $errors->first('full_name') }}</small></div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" name="email_address" class="form-control" value="{{$buyer->email}}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                    <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{$buyer->phone_number}}" aria-label="Phone Number">
                    @if ($errors->has('phone_number'))
                        <div class="text-danger form-text"><small>{{ $errors->first('phone_number') }}</small></div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Profile Image</label>
                <input name="profile_image" type="file" class="form-control" id="inputGroupFile02">
            </div>

            <button type="submit" class="btn btn-secondary">Update Details</button>
        </form>
    </div>
@endsection
