<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
@extends('layouts.app')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <h1>{{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tape kadai">{{ __('課題') }}</div>
                <div class="card-body kadailist">
                    @foreach ($tasks as $task)
                        <p>title:{{ $task->title }}
                        end_at:{{ $task->end_at }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 pjt">
            <h3>プロジェクト</h3>
            <div>
                @foreach ($projects as $project)
                    id:{{ $project->id }}
                    name:{{ $project->name }}
                    description:{{ $project->description }}<br><br>
                @endforeach
            </div>
            <a href="#" class="btn-circle-3d">＋</a>
        </div>   
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header tape tuti">{{ __('通知') }}</div>
    
                <div class="card-body tutilist">
                    @foreach ($requests as $request)
                        <div>承認待ち：{{ $request->project->name }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
