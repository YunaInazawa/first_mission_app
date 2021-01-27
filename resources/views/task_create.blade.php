<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h3>タスク作成</h3>
        </div>
            <div class="col-lg-12">
                {{-- <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row">
                                <span class="col-lg-7 offset-lg-1">KINOKOLISTO</span>
                                <span class="col-lg-2">タスク<input type="checkbox"></span><span class="col-lg-2">デザイン<input type="checkbox"></span>
                                <hr class="col-lg-10">
                                <span class="col-lg-7 offset-lg-1">TOP</span>
                                <span class="col-lg-2">タスク<input type="checkbox"></span><span class="col-lg-2">デザイン<input type="checkbox"></span>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div id="dialog" class="dialog">
                                    <div class="dialogBackground"></div>
                                    <div class="dialogContent">
                                        <div class="dialogMsg">
                                            ダイアログメッセージ
                                        </div>
                                        <div>
                                            <input type="text"><br>
                                            <input type="button" value="はい" onclick="func();" />
                                            <input type="button" value="いいえ" onclick="dialogHide('dialog');" />
                                        </div>
                                    </div>
                                </div>
                                <input class="btn_plus_circle btn_plus_check" type="checkbox" onclick="dialogShow('dialog');" id="check">
                                <label for="check" class="btn_plus_circle">+</label>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="card input-card">
                    <div class="card-body">
                        <form method="post" action="{{ route('task_new', $sceneId) }}">
                        @csrf
                            <div class="form-group row input_box">
                                <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('タイトル') }}</label>
                                <div class="col-lg-9">
                                    <input id="task_title" type="text" class="form-control" name="task_title" value="" autofocus>
                                </div>
                            </div>
                            <div class="form-group row input_box">
                                <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('担当') }}</label>
                                <div class="col-lg-9">
                                    <select id="task_user" type="text" class="form-control" name="task_user">
                                        @foreach ($members as $member)
                                            <option value="{{ $member->user->id }}">{{ $member->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row input_box">
                                <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('開始') }}</label>
                                <div class="col-lg-9">
                                    <input id="task_start" type="date" class="form-control" name="task_start" value="" autofocus>
                                </div>
                            </div>
                            <div class="form-group row input_box">
                                    <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('終了') }}</label>
                                    <div class="col-lg-9">
                                        <input id="task_end" type="date" class="form-control" name="task_end" value="" autofocus>
                                    </div>
                                </div>
                            <div class="form-group row input_box">
                                <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('状態') }}</label>
                                <div class="col-lg-9">
                                    <select id="task_status" type="text" class="form-control" name="task_status">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row input_box">
                                <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('概要') }}</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control gaiyo" maxlength="200" name="task_description" cols="50" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-5">
                                    <button type="reset" class="btn btn-primary">キャンセル</button>
                                </div>
                                <div class="col-lg-5 offset-lg-2 text-md-right">
                                    <button type="submit" class="btn btn-primary">作成</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection
