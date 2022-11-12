@extends('base.index')

@section('content')
    <div class="auth-box container-fluid col-md-3">

        @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
        @endif
        <h5 class="text-center">Sign up to start your session</h5>

        <form action="{{ route('buyer.register') }}" method="post">
            @csrf

            <div class="mb-3">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                @if ($errors->has('username'))
                    <div class="text-danger form-text"><small>{{ $errors->first('username') }}</small></div>
                @endif
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="Full name">
                @if ($errors->has('full_name'))
                    <div class="text-danger form-text"><small>{{ $errors->first('full_name') }}</small></div>
                @endif
            </div>

            <div class="mb-3">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                @if ($errors->has('email'))
                    <div class="text-danger form-text"><small>{{ $errors->first('email') }}</small></div>
                @endif
            </div>

            <div class="mb-3">
                <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone number">
                @if ($errors->has('phone_number'))
                    <div class="text-danger form-text"><small>{{ $errors->first('phone_number') }}</small></div>
                @endif
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <div class="text-danger form-text"><small>{{ $errors->first('password') }}</small></div>
                @endif
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                @if ($errors->has('password_confirm'))
                    <div class="text-danger form-text"><small>{{ $errors->first('password_confirm') }}</small></div>
                @endif
            </div>

            <!-- /.col -->
            <div class="text-center">
                <div class="mt-3 text-center col-md-12">
                    <button type="submit" class="btn btn-primary form-control text-uppercase">Register</button>
                </div>
            </div>

        </form>
        <div class="text-center">
            <a href="{{ route('buyer.show.login') }}"  style="margin-bottom: 30px;">I already have a membership</a>
        </div>

    </div>
@endsection
