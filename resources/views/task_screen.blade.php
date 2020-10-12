<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h3>画面管理</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <span class="col-lg-7 offset-lg-1">KINOKOLISTO</span>
                        <span class="col-lg-2">タスク<input type="checkbox"></span><span class="col-lg-2">デザイン<input type="checkbox"></span>
                        <hr class="col-lg-10">
                        <span class="col-lg-7 offset-lg-1">TOP</span>
                        <span class="col-lg-2">タスク<input type="checkbox"></span><span class="col-lg-2">デザイン<input type="checkbox"></span>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                            <a href="{{ url('/') }}" class="btn-circle-3d">＋</a>
                        </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-2 text-md-right">
                <button class="btn btn-primary">作成</button>
            </div>
        </div>
    </div>
</div>
@endsection
