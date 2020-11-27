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
            <h3>プロジェクト編集</h3>
        </div>
        <div class="col-lg-12">
            <div class="card input-card">
                <div class="card-body">
                    <form method="post" action="{{ route('app_update', $projectData->id) }}">
                    @csrf
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('プロジェクト名') }}</label>
                            <div class="col-lg-9">
                                <input id="project_name" type="text" class="form-control" name="project_name" value="{{ $projectData->name }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('使用言語・技術') }}</label>
                            <div class="col-lg-9">
                                <input id="project_using" type="text" class="form-control" name="project_using" value="{{ $projectData->using }}">
                            </div>
                        </div>
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('概要') }}</label>
                            <div class="col-lg-9">
                                <textarea class="form-control gaiyo" maxlength="200" name="project_description" cols="50" rows="10">{!! nl2br($projectData->description) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-5">
                                <button type="submit" name="back" class="btn btn-primary">キャンセル</button>
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
