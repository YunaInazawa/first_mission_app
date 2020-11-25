<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_tmp.css') }}" rel="stylesheet">
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- フラッシュメッセージ -->
            @if (session('flash_message'))
                <div class="flash_message text-center">
                    {!! nl2br(session('flash_message')) !!}
                    <hr>
                </div>
            @endif

            <div class="row justify-content-center">
                <h1>{{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tag tag_purple">{{ __('課題') }}</div>
                <div class="card-body tag_list">
                    @foreach ($tasks as $task)
                        <div class="tag_item"><span>{{ $task->title }}</span><hr>{{ $task->end_at }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 pjt">
            <h3>プロジェクト</h3>
            <div>
                @foreach ($projects as $project)
                    <a class="pjt_list" href="{{ url('/app/'.$project->id) }}">
                        <div>
                            <span class="pjt_name">{{ $project->name }}</span><br>
                            description:{{ $project->description }}
                        </div>    
                    </a>
                    <hr>
                @endforeach
            </div>
            <a href="{{ route('app_create') }}" class="btn_plus_circle">＋</a>
        </div>   
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tag tag_orange">{{ __('通知') }}</div>
                <div class="card-body tag_list">
                    @foreach ($requests as $request)
                    <div class="tag_item">承認待ち：{{ $request->project->name }}<hr>
                            <div><button class="btn btn-primary" onclick=location.href="{{ route('judgment_join', ['id' => $request->id, 'reply' => true]) }}"> 加入 </button></div>
                            <div class="reject"><button class="btn btn-primary" onclick=location.href="{{ route('judgment_join', ['id' => $request->id, 'reply' => false]) }}"> 拒否 </button></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
