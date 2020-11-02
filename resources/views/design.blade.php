<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/design.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="row">
                <div class="col-lg-2">
                    <div id="nav-drawer">
                        <input id="nav-input" type="checkbox" class="nav-unshown">
                        <label id="nav-open" class="fas fa-bars" for="nav-input"></label>
                        <label class="nav-unshown" id="nav-close" for="nav-input"></label>
                        <div id="nav-content">
                            <span class="tab-trigger js-tab-trigger is-active" data-id="tab01">KINOKOLIST</span>
                            <span class="tab-trigger js-tab-trigger" data-id="tab02">TOP</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <aside class="sidemenu sidemenu_left">
                        <h2>オブジェクト</h2>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_btn">BUTTON</span><span class="col-lg-8 obj_name">Button</span></div>
                            </button>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_radio">●</span><span class="col-lg-8 obj_name">RadioButton</span></div>
                            </button>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_textb">abc |</span><span class="col-lg-8 obj_name">TextBox</span></div>
                            </button>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_label">label</span><span class="col-lg-8 obj_name">Label</span></div>
                            </button>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_checkb"><label class="fas fa-check"></label></span><span class="col-lg-8 obj_name">CheckBox</span></div>
                            </button>
                            <button>
                                <div class="row"><span class="col-lg-4 ic ic_screen"></span><span class="col-lg-8 obj_name">Screen</span></div>
                            </button> 
                    </aside>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content">
                <!-- 画面一覧の表示 -->
                <div id="tab01" class="tab-content__item js-tab-target is-active">
                    <canvas class="can col-lg-12"></canvas>
                </div>
                <!-- 画面遷移が表示される -->
                <div id="tab02" class="tab-content__item js-tab-target">
                    <canvas class="can col-lg-12" style="background-color:red;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-2 ">
            <aside class="sidemenu sidemenu_right">
                <div class="row">
                    <h2 class="col-lg-12">詳細</h2>
                    <hr class="col-lg-12 sidemenu_hr">
                    <p class="col-lg-3">名前</p><div class="v_line_fix"></div>
                    <input class="col-lg-8" type="text">
                    <hr class="col-lg-12 sidemenu_hr">
                    <span class="col-lg-3">高さ</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <span class="col-lg-3">幅</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <hr class="col-lg-12 sidemenu_hr">
                    <span class="col-lg-3">座標X</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                    <span class="col-lg-3">座標Y</span><div class="v_line_fix"></div><input class="col-lg-2" type="text">
                </div>
            </aside>
        </div>
    </div>
</div>



          
      

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>
<script src="{{ asset('js/tab.js') }}"></script>

@endsection
