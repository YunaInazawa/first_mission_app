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
        <div class="col-lg-9">
            <div class="row">
                <div class="card col-lg-12">
                    <!-- プロジェクトについて(名、メンバー、概要など) -->
                    <div class="card-body">
                        <!-- プロジェクト名 -->
                        <h4>KINOKONOSATO☆</h4>
                        <hr>
                        <!-- メンバー一覧表示
                        ＊＊＊＊この画面でメンバー追加をするか新画面でするか未定 -->
                        <div class="row menber">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('メンバー') }}</label>
                            <div class="col-lg-9">
                                <a href="{{ url('/') }}" class="btn-circle-3d">＋</a>
                            </div>
                        </div>
                        <hr>
                        <!-- プロジェクト概要 -->
                        <p>きのこ　たくさん　あるよ</p>
                    </div>
                </div>
                <!-- 作成した画面を表示させる 
                ＊＊＊＊今後idの変更の可能性あり。-->
                <div class="col-lg-12">
                    <div class="tab_wrap">
                        <input id="tab1" type="radio" name="tab_btn" checked>
                        <input id="tab2" type="radio" name="tab_btn">
                        <input id="tab3" type="radio" name="tab_btn">
                        <input id="tab4" type="radio" name="tab_btn">
                         
                        <div class="tab_area">
                            <label class="tab1_label" for="tab1">画面一覧</label>
                            <label class="tab2_label" for="tab2">画面遷移図</label>
                            <label class="tab3_label" for="tab3">タスク</label>
                            <label class="tab4_label" for="tab4">デザイン</label>
                        </div>
                        <div class="panel_area">
                            <!-- 画面一覧の表示 -->
                            <div id="panel1" class="tab_panel">
                                <div class="row">
                                    <span class="col-lg-7 offset-lg-1">KINOKOLISTO</span>
                                    <span class="col-lg-2">タスク</span><span class="col-lg-2">デザイン</span>
                                    <hr>
                                    <span class="col-lg-7 offset-lg-1">TOP</span>
                                    <span class="col-lg-2">タスク</span><span class="col-lg-2">デザイン</span>
                                </div>
                            </div>
                            <!-- 画面遷移が表示される -->
                            <div id="panel2" class="tab_panel">
                                <canvas></canvas>
                            </div>
                            <!-- タスクが表示される -->
                            <div id="panel3" class="tab_panel">
                            </div>
                            <!-- デザインが表示される -->
                            <div id="panel4" class="tab_panel">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ログ表示 -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tape tuti">{{ __('ログ') }}</div>
                <div class="card-body tutilist">
                    <p>キノコLOVEさんがKINOKOLISTのデザインを更新しました</p>
                    <hr>
                    <p>キノコ○ねさんがKINOKO画面を削除しました</p>
                    <hr>
                    <p>キノコLOVEさんがKINOKO画面を作成しました</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
