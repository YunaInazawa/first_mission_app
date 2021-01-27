<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/screen_detail.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-12 text-center">

            <!-- フラッシュメッセージ -->
            @if (session('flash_message'))
                <div class="flash_message text-center">
                    {!! nl2br(session('flash_message')) !!}
                    <hr>
                </div>
            @endif

            <h3>{{ $sceneData->name }}</h3>
            <p>{!! nl2br($sceneData->description) !!}</p>

            <!-- UPDATE ダイアログ -->
            <form method="POST" action="{{ route('scene_update', $sceneData->id) }}">
                @csrf
                <div id="dialogUpdate" class="dialog">
                    <div class="dialogBackground"></div>
                    <div class="dialogContent">
                        <div class="dialogMsg">
                            画面情報を変更します
                        </div>
                        <hr class="dialog_hr">
                        <div>
                            <input type="text" class="form-control dialog_text" size="25" name="screenName" value="{{ $sceneData->name }}">
                            <textarea name="screenDescription">{!! nl2br($sceneData->description) !!}</textarea>
                            <i class="fas fa-search"></i><br>
                            <input type="submit" class="btn btn-primary dialog_btn" value="はい" />
                            <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('dialogUpdate');" />
                        </div>
                    </div>
                </div>
                <span onclick="dialogShow('dialogUpdate');"><a href="#">--- UPDATE ---</a></span>
            </form>

            <!-- DELETE ダイアログ -->
            <div id="dialogDelete" class="dialog">
                <div class="dialogBackground"></div>
                <div class="dialogContent">
                    <div class="dialogMsg">
                        画面を削除します
                    </div>
                    <hr class="dialog_hr">
                    <div>
                        画面「{{ $sceneData->name }}」を削除します<br />
                        復元できませんが、よろしいですか？
                        <input type="button" class="btn btn-primary dialog_btn" value="はい" onclick=location.href="{{ route('scene_delete', $sceneData->id) }}" />
                        <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('dialogDelete');" />
                    </div>
                </div>
            </div>
            <span onclick="dialogShow('dialogDelete');"><a href="#">--- DELETE ---</a></span>
        </div>
        <div class="col-lg-12">

            <!-- タスクとデザイン -->
            <div class="col-lg-10 offset-lg-1">
                <div class="tab_wrap">
                    <input id="tab1" type="radio" name="tab_btn" checked>
                    <input id="tab2" type="radio" name="tab_btn">
                        
                    <div class="tab_area">
                        <label class="tab1_label" for="tab1">タスク</label>
                        <label class="tab2_label" for="tab2">デザイン</label>
                    </div>
                    <div class="panel_area">

                        <!-- タスク -->
                        <div id="panel1" class="tab_panel">
                            <div class="row"><div class="col-md-10 offset-md-1">
                                @if(count($sceneData->tasks) != 0)
                                
                                    <table class="table table-striped table-sm">
                                    @foreach($sceneData->tasks as $task)
                                        <tr 
                                        @if($task->status->id == 1)
                                        class="table-success"
                                        @elseif($task->status->id == 6)
                                        class="table-danger"
                                        @elseif($task->status->id == 5)
                                        class="table-warning"
                                        @endif>
                                            <td><a href="{{ route('task_detail', $task->id) }}">{{ $task->title }}</a></td>
                                            <td colspan="2">{!! nl2br($task->description) !!}</td>
                                            <td>{{ $task->status->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $task->user->name }}</td>
                                            <td></td>
                                            <td colspan="2">{{ $task->end_at }}</td>
                                        </tr>
                                    @endforeach
                                    </table>
                                @endif
                                
                                <br />
                                <a href="{{ route('app_create') }}" class="btn_plus_circle">＋</a>
                                </div>
                            </div>

                        </div>

                        <!-- デザイン -->
                        <div id="panel2" class="tab_panel">
                            <!-- <canvas></canvas> -->
                            <div class="text-center">
                                <img src="{{ asset('storage/images/sampleImage2.png') }}"><br />
                                <a href="{{ route('design', $sceneData->project->id) }}">--- EDIT ---</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>
<script src="{{ asset('js/tab.js') }}"></script>

@endsection
