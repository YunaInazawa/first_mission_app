<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/transition.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <aside id="sub">
                <h2>画面</h2>
                <ul>
                    <li>KINOKOLIST</li>
                    <li>TOP</li>
                </ul>
            </aside>
        </div>
        <div class="col-lg-10">
            <div class="row">
                <canvas class="can col-lg-12"></canvas>
            </div>
        </div>
    </div>
</div>



          
      

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection
