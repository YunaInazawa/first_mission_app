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
        <div class="col-lg-12">
            <h3 class="text-center">{{ $sceneData->name }}</h3>
            <div class="text-center"><a href="#">--- DELETE ---</a></div>
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

                                @if(count($sceneData->tasks) == 0)
                                nodata
                                @else
                                <div class="row">
                                    <table class="col-md-10 offset-md-1 table table-striped table-sm">
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
                                </div>
                                @endif

                            </div>

                            <!-- デザイン -->
                            <div id="panel2" class="tab_panel">
                                <canvas></canvas>
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
