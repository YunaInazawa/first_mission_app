@extends('layouts.app_header')

@section('content')

<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<canvas id="canvas"></canvas>
<div class="container logincontent">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <h1>LOGIN</h1>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row email">
                    <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row pass">
                    <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Pass') }}</label>
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
                    <div class="col-md-6 offset-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row justify-content-center login">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            {{ __('ログイン') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <a href="{{ route('register') }}">
                                {{ __('新規作成') }}
                            </a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
         
<svg version="1.1" xmlns="http://www.w3.org/2000/svg"><path id="wave" d=""/></svg>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg"><path id="wave2" d=""/></svg>
          
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/85188/jquery.wavify.js"></script>

<script src="{{ asset('js/app_guest.js') }}"></script>
@endsection
