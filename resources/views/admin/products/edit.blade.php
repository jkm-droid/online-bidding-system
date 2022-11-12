@extends('base.dashboard_portal')

@section('content')

    <div style="--bs-breadcrumb-divider: '>';" class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb bg-light mb-0 text-gray-800" >
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Seller</li>
        </ol>
    </div>

    <div class="col-md-12">

        @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
        @endif
        <form action="{{ route('admin.seller.edit', $seller->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ $seller->full_name }}" placeholder="Full name">
                    @if ($errors->has('full_name'))
                        <div class="text-danger form-text"><small>{{ $errors->first('full_name') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $seller->email }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <div class="text-danger form-text"><small>{{ $errors->first('email') }}</small></div>
                    @endif
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" name="phone_number" value="{{ $seller->phone_number }}" placeholder="Phone number">
                    @if ($errors->has('phone_number'))
                        <div class="text-danger form-text"><small>{{ $errors->first('phone_number') }}</small></div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" value="{{ $seller->location }}" placeholder="Location">
                    @if ($errors->has('location'))
                        <div class="text-danger form-text"><small>{{ $errors->first('location') }}</small></div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-secondary">Update Seller</button>

        </form>

    </div>
@endsection
