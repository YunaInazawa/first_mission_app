<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/design.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <aside id="sub">
                <h2>オブジェクト</h2>
                <ul>
                    <li>Button</li>
                    <li>RadioButton</li>
                    <li>TextBox</li>
                    <li>label</li>
                    <li>checkBox</li>
                    <li>screen</li>
                </ul>
            </aside>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <canvas class="can col-lg-12"></canvas>
            </div>
        </div>
        <div class="col-lg-2 ">
            <aside id="sub2">
                <div class="row">
                    <h2 class="col-lg-12">詳細</h2>
                    <p class="col-lg-3">名前</p><div class="v_line_fix"></div>
                    <input class="col-lg-8" type="text">
                    <hr class="col-lg-12">
                    <span class="col-lg-3">高さ</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <span class="col-lg-3">幅</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <hr class="col-lg-12">
                    <span class="col-lg-3">座標X</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <span class="col-lg-3">座標Y</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                </div>
            </aside>
        </div>
    </div>
</div>



          
      

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection
