
@extends('layouts.layout_login')

@section('content')


<form action="{{ route('register') }}" method="POST">
    @csrf
      <h1 class="h3 font-weight-normal" style="text-align: center">Đăng ký tài khoản Webphim</h1>
      <div class="row mb-12">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

        <div class="col-md-12">
            <input id="name" type="name" placeholder="Type your name" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
      <div class="row mb-12">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-12">
            <input id="email" type="email" placeholder="Type your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-12">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <div class="col-md-12">
            <input id="password" type="password" placeholder="Type your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    
    <div class="row mb-12">
        <label for="password-confirm" class="col-form-label text-md-end ml-3">{{ __('Confirm Password') }}</label>

        <div class="col-md-12">
            <input type="password" id="password-confirm" placeholder="Retype your password" class="form-control" name="password_confirmation" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
      
      <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign up</button>
      <hr>
       <div>You have an account?</div> 
        <a href="{{ route('login') }}">
            <button class="btn btn-primary btn-block" type="button"><i class="fas fa-user-plus"></i> Sign In</button>
        </a>
    </form> 

@endsection
