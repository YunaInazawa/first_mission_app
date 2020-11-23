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
            <h3 class="text-center">{{ $taskData->title }}</h3>
            <div class="text-center"><a href="#">--- DELETE ---</a></div>
        </div>
        <div class="card col-lg-12">
            
            <div class="card-body">
                <div class="hidden_box row">

                    <div class="col-lg-11">

                        <!-- 担当 -->
                        <h4>< 担当 ></h4>
                        <p>{{ $taskData->user->name }}</p>
                        <hr>

                        <!-- 期間 -->
                        <h4>< 期間 ></h4>
                        <p>{{ $taskData->start_at }} ～ {{ $taskData->end_at }}</p>
                        <hr>

                        <!-- 状態 -->
                        <h4>< 状態 ></h4>
                        <p>{{ $taskData->status->title }}</p>
                        <hr>

                        <!-- タスク詳細 -->
                        <h4>< 詳細 ></h4>
                        <p>{!! nl2br($taskData->description) !!}</p>
                        <hr>

                        <!-- 子タスク -->
                        <h4>< 子タスク ></h4>
                        @foreach( $andTasksData as $task )
                        <p>- <a href="{{ route('task_detail', $task->id) }}">{{ $task->title }} : {{ $task->status->title }}</a></p>
                        @endforeach

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
