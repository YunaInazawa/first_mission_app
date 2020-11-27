<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_tmp.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="row">
                <!-- フラッシュメッセージ -->
                @if (session('flash_message'))
                    <div class="flash_message">
                        {!! nl2br(session('flash_message')) !!}
                        <hr>
                    </div>
                @endif

                <div class="card col-lg-12">
                    <!-- プロジェクトについて(名、メンバー、概要など) -->
                    <div class="card-body">
                        <div class="hidden_box row">
                            <!-- プロジェクト名 -->
                            <h4 class="col-lg-11">{{ $project_data->name }}</h4>
                            <input type="checkbox" class="hidden_input" id="label1" />
                            <label for="label1" class="hidden_label fas fa-caret-down col-lg-1"></label>
                            <div class="hidden_show col-lg-12">
                                <!-- メンバー一覧表示 -->
                                <hr>
                                <div class="row menber">
                                    <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('メンバー') }}</label>
                                    <div class="col-lg-9">
                                        <form method="POST" action="{{ route('add_member', $project_data->id) }}">
                                            @csrf
                                            <div id="dialog" class="dialog">
                                                <div class="dialogBackground"></div>
                                                <div class="dialogContent">
                                                    <div class="dialogMsg">
                                                        メンバーを追加します
                                                    </div>
                                                    <hr class="dialog_hr">
                                                    <div>
                                                        <input type="text" class="form-control dialog_text" size="25" name="userName" autocomplete="on" list="user_name">
                                                        <datalist id="user_name">
                                                        @foreach( $users_data as $user )
                                                        <option id="{{ $user->id }}" value="{{ $user->name }}">
                                                        @endforeach
                                                        </datalist>
                                                        <i class="fas fa-search"></i><br>
                                                        <input type="submit" class="btn btn-primary dialog_btn" value="はい" />
                                                        <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('dialog');" />
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="btn_plus_circle btn_plus_check" type="checkbox" onclick="dialogShow('dialog');" id="check">
                                        </form>
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
                                <hr>
                                <a href="{{ route('app_edit', $project_data->id) }}">--- EDIT ---</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 作成した画面を表示させる -->
                <div class="col-lg-12">
                    <div class="tab_wrap">
                        <input id="tab1" type="radio" name="tab_btn" checked>
                        <input id="tab2" type="radio" name="tab_btn">
                         
                        <div class="tab_area">
                            <label class="tab1_label" for="tab1">画面一覧</label>
                            <label class="tab2_label" for="tab2">画面遷移図</label>
                        </div>
                        <div class="panel_area">
                            <!-- 画面一覧の表示 -->
                            <div id="panel1" class="tab_panel">
                                <div class="row">
                                    @foreach( $project_data->scenes as $scene )
                                    <span class="col-lg-7 offset-lg-1"><a href="{{ route('screen_detail', $scene->id) }}">{{ $scene->name }}</a></span>
                                    <span class="col-lg-2">タスク<input class="checkbox" type="checkbox"></span><span class="col-lg-2">デザイン<input class="checkbox" type="checkbox"></span>
                                    <hr class="col-lg-12 tab_hr">
                                    @endforeach
                                </div>

                                <!-- 画面追加ダイアログ -->
                                <form method="POST" action="{{ route('add_screen', $project_data->id) }}">
                                    @csrf
                                    <div id="screen_dialog" class="dialog">
                                        <div class="dialogBackground"></div>
                                        <div class="dialogContent">
                                            <div class="dialogMsg">
                                                画面を追加します
                                            </div>
                                            <hr class="dialog_hr">
                                            <div>
                                                <input type="text" class="form-control dialog_text" size="25" name="screenName">
                                                <textarea name="screenDescription"></textarea>
                                                <i class="fas fa-search"></i><br>
                                                <input type="submit" class="btn btn-primary dialog_btn" value="はい" />
                                                <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('screen_dialog');" />
                                            </div>
                                        </div>
                                    </div>
                                    <label class="btn_plus_circle col-lg-7 offset-lg-1" onclick="dialogShow('screen_dialog');" >+</label>
                                </form>
                            </div>
                            <!-- 画面遷移が表示される -->
                            <div id="panel2" class="tab_panel text-center">
                                <a href="{{ route('transition', $project_data->id) }}">
                                    <img src="{{ asset('storage/images/sampleImage.png') }}" style="width: 100%;">
                                </a>
                                <a href="{{ route('transition_edit', $project_data->id) }}">--- EDIT ---</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ログ表示 -->
        <div class="col-lg-3">
            <div class="card card_log">
                <div class="card-header tag tag_purple">{{ __('タスク') }}</div>
                <div class="card-body tag_list">
                    @foreach( $project_data->scenes as $scene )
                    @foreach( $scene->tasks as $task )
                    @if( $task->status_id != 1)
                    @if( $task->user->id == Auth::id())
                    <p>{{ $task->end_at->format('Y/m/d') }}までに<br>{{ $scene->name }}<br>{{ $task->title }}</p>
                    <hr>
                    @endif
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
            <div class="card card_log">
                <div class="card-header tag tag_orange">{{ __('ログ') }}</div>
                <div class="card-body tag_list">
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
