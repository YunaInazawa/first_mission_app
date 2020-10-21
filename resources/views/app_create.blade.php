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
            <h3>プロジェクト作成</h3>
        </div>
        <div class="col-lg-12">
            <div class="card input-card">
                <div class="card-body">
                    <form method="post" action="{{ route('app_new') }}">
                    @csrf
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('プロジェクト名') }}</label>
                            <div class="col-lg-9">
                                <input id="project_name" type="text" class="form-control" name="project_name" value="" autofocus>
                            </div>
                        </div>
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('使用言語・技術') }}</label>
                            <div class="col-lg-9">
                                <input id="project_using" type="text" class="form-control" name="project_using" value="" autofocus>
                            </div>
                        </div>
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('概要') }}</label>
                            <div class="col-lg-9">
                                <textarea class="form-control gaiyo" maxlength="200" name="example" cols="50" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row input_box">
                            <label for="" class="col-lg-2 col-form-label text-md-right">{{ __('メンバー') }}</label>
                            <div class="col-lg-9">
                                <div id="dialog">
                                    <div id="dialogBackground"></div>
                                    <div id="dialogContent">
                                        <div id="dialogMsg">
                                            メンバーを追加します
                                        </div>
                                        <hr class="dialog_hr">
                                        <div>
                                            <input type="text" class="form-control dialog_text" size="25" placeholder="MailAddress">
                                            <i class="fas fa-search"></i><br>
                                            <input type="button" class="btn btn-primary dialog_btn" value="はい" onclick="func();" />
                                            <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide();" />
                                        </div>
                                    </div>
                                </div>
                                <input class="btn_plus_circle btn_plus_check" type="checkbox" onclick="dialogShow();" id="check">
                                <label for="check" class="btn_plus_circle">+</label>
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
