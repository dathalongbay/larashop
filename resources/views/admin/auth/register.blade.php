@extends('admin.layouts.register')

@section('title', 'Laravel register')

@section('content')
    <h2>Sign Up</h2>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="username">
            <span class="username">Username:</span>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="username">
            <span class="username">Email:</span>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="password-agileits">
            <span class="username">Password:</span>

            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="password-agileits">
            <span class="username">Confirm Password:</span>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            <div class="clearfix"></div>
        </div>
        <div class="login-w3">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="back">
        <a href="index.html">Back to home</a>
    </div>
    <div class="footer">
        <p>&copy; 2016 LaraCMS . All Rights Reserved</p>
    </div>
@endsection
