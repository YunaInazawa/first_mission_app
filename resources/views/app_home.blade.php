<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_home.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="row">
                <div class="card col-lg-12">
                    <!-- プロジェクトについて(名、メンバー、概要など) -->
                    <div class="card-body">
                        <!-- プロジェクト名 -->
                        <h4>{{ $project_data->name }}</h4>
                        <hr>
                        <!-- メンバー一覧表示
                        ＊＊＊＊この画面でメンバー追加をするか新画面でするか未定 -->
                        <div class="row menber">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('メンバー') }}</label>
                            <div class="col-lg-9">
                                    <div id="dialog">
                                            <div id="dialogBackground"></div>
                                            <div id="dialogContent">
                                                <div id="dialogMsg">
                                                    ダイアログメッセージ
                                                </div>
                                                <div>
                                                    <input type="text"><br>
                                                    <input type="button" value="はい" onclick="func();" />
                                                    <input type="button" value="いいえ" onclick="dialogHide();" />
                                                </div>
                                            </div>
                                        </div>
                                        <input class="btn_plus_circle btn_plus_check" type="checkbox" onclick="dialogShow();" id="check">
                                        <!-- メンバー表示 -->
                                        [ 参加者 ]<br />
                                        @foreach( $members as $m )
                                        {{ $m->role->name }} : {{ $m->user->name }}<br />
                                        @endforeach
                                        [ 申請中 ]<br />
                                        @foreach( $members_yet as $m )
                                        {{ $m->user->name }}<br />
                                        @endforeach
                                        <label for="check" class="btn_plus_circle">+</label>
                            </div>
                        </div>
                        <hr>
                        <!-- プロジェクト概要 -->
                        <p>[ 使用言語・技術 ]<br />{{ $project_data->using }}</p>
                        <p>[ 概要 ]<br />{!! nl2br($project_data->description) !!}</p>
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
                                    @foreach( $project_data->scenes as $scene )
                                    <span class="col-lg-7 offset-lg-1">{{ $scene->name }}</span>
                                    <span class="col-lg-2">タスク</span><span class="col-lg-2">デザイン</span>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                            <!-- 画面遷移が表示される -->
                            <div id="panel2" class="tab_panel">
                                <canvas></canvas>
                            </div>
                            <!-- タスクが表示される -->
                            <div id="panel3" class="tab_panel">
                                <div class="row">
                                    @foreach( $project_data->scenes as $scene )
                                    @foreach( $scene->tasks as $task )
                                    <span class="col-lg-7 offset-lg-1">[ {{ $scene->name }} ] {{ $task->start_at->format('Y/m/d') }} ～ {{ $task->end_at->format('Y/m/d') }} < {{ $task->status->title }} ></span>
                                    <span class="col-lg-2">{{ $task->user->name }} : {{ $task->title }}</span>
                                    <span class="col-lg-2">{!! nl2br($task->description) !!}</span>
                                    <hr>
                                    @endforeach
                                    @endforeach
                                </div>
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
                    @foreach( $logs as $l )
                    <p>{{ $l->created_at->format('Y/m/d') }}<br />{{ $l->text }}</p>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>
@endsection
