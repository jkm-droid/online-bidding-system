@extends('base.index')

@section('content')
    <div class="auth-box col-md-3 container-fluid">

        @if ($message = Session::get('success'))
            <p class="alert alert-success">{{ $message }}</p>
        @endif
        @if ($message = Session::get('error'))
            <p class="alert alert-danger">{{ $message }}</p>
        @endif
        <h5 class="login-box-msg text-center">Request a password reset</h5>

        <form action="{{ route('buyer.forgot_submit') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" placeholder="Enter your email">
                @if ($errors->has('email'))
                    <div class="text-danger form-text">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block form-control">Request Password Reset</button>
            </div>
        </form>

    </div>

@endsection
