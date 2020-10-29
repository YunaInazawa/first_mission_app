<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <h1>{{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tag tag_purple">{{ __('課題') }}</div>
                <div class="card-body tag_list">
                    <p>・課題１</p>
                    <p>・課題２</p>
                    <p>・課題３</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pjt">
            <h3>プロジェクト</h3>
            <div></div>
            <a href="{{ route('app_create') }}" class="btn_plus_circle">＋</a>
        </div>   
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tag tag_orange">{{ __('通知') }}</div>
    
                <div class="card-body tag_list">
                    <div>通知１</div>
                    <div>通知２</div>
                    <div>通知３</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
