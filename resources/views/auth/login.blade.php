@extends('layouts.layout_login')

@section('content')


<form action="{{route('login')}}" method="POST">
    @csrf
      <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Đăng nhập vào quản lý webphim</h1>
      <div class="social-login">
          <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
          <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>
      </div>
      <p style="text-align:center"> OR  </p>
      <div class="row mb-12">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-12">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
      
      <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
      <a href="#" id="forgot_pswd">Forgot password?</a>
      <hr>
      <!-- <p>Don't have an account!</p>  -->
      {{-- <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
      </form> --}}

      {{-- <form action="/reset/password/" class="form-reset">
          <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
          <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
          <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
      </form> --}}
      
      {{-- <form action="/signup/" class="form-signup">
          <div class="social-login">
              <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
          </div>
          <div class="social-login">
              <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
          </div>
          
          <p style="text-align:center">OR</p>

          <input type="text" id="user-name" class="form-control" placeholder="Full name" required="" autofocus="">
          <input type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="">
          <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
          <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="">
          <button class="btn btn-success btn-block" type="button" id="btn-signup"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</button>
        </form> --}}
          {{-- <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div> --}}
          {{-- <a href="{{url('/')}}" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a> --}}
      </form>

@endsection

{{-- @extends('layouts.layout_login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
