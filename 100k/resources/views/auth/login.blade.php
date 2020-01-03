@extends('layouts.app')

@section('content')
<div class="container vanish login">
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding-top:13%; color:#a69cab;">
          <center><h3 class="phone-auth-title auth-pages-top-fix">Login In With A 100k Account </h3></center><br/>
            <div class="card vanish login-card" style="border-width:0px;transform: scale(.7)" >
                <div class="card-body login-body-tweaks z-depth-1" >
                  <center><img class="phone-auth-logo"  style="cursor:pointer" src="{{asset('default-imgs/100k-ico.png')}}" onclick="window.location ='/'"/></center>
                    <form method="POST" action="{{ route('login') }}" class="phone-auth-form">
                        @csrf
                        <div class="form-group row">
                         
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary auth-btn">
                                    {{ __('Login') }}
                                </button>
                                <a type="submit" href="/register"class="btn btn-danger auth-btn2" >
                                    {{ __('Register') }}
                                </a>

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
@endsection
