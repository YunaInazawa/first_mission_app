<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/task_detail.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h3>タスク管理</h3>
        </div>
            <div class="col-lg-12">
                <div class="card">
                <form method="POST" action="">
                    <div class="cp_tab ">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($scenes_data as $scene_data)
                            <input type="radio" name="cp_tab" id="tab2_{{$i}}"
                            @if ($i == 1)
                                checked
                            @endif>
                            <label for="tab2_{{$i++}}">{{ $scene_data->name }}</label>
                        @endforeach

                        <div class="cp_tabpanels">
                            @foreach ($scenes_data as $scene_data)
                                <div class="cp_tabpanel">
                                    @if ( count($tasks_data[$scene_data->id]) <= 0 )
                                        nodata
                                    @else
                                        <div class="row">
                                            @foreach ($tasks_data[$scene_data->id] as $task_data)
                                                <span class="col-lg-4">{{ $task_data->title }}</span><div class="v_line_fix"></div>
                                                <span class="col-lg-4">{{ $task_data->description }}</span><div class="v_line_fix"></div>
                                                <span class="col-lg-4">{{ $task_data->end_at }}</span><div class="v_line_fix"></div>
                                                <span class="col-lg-4">{{ $task_data->user->name }}</span><div class="v_line_fix"></div>
                                                <span class="col-lg-4">{{ $task_data->status->title }}</span><div class="v_line_fix"></div>
                                                <hr class="col-lg-12">
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="col-lg-12">
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
                                        <label for="check" class="btn_plus_circle">+</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-12 text-lg-right">
                    <button class="btn btn-primary">作成</button>
                </div>
            </div>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection
