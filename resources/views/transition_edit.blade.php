@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/design.css') }}" rel="stylesheet">
<link href="{{ asset('css/transition_edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <aside class="sidemenu sidemenu_left">
                <h2>スクリーン</h2>
                @for($i = 0;$i != 3;$i++)
                <button>
                    <div class="row dragitem screennames" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" id="drop_screen_{{$i}}"><span>Screen{{$i}}</span></div>
                </button>
                @endfor
                <input type="text" id="select_screen" value="" hidden>
            </aside>
        </div>
        <div class="col-lg-8">
            <div class="screens" id="drop" ondragover="DragOver(event)" ondrop="Drop(event)" >
            </div>
        </div>
        <div class="col-lg-2 ">
            <aside class="sidemenu sidemenu_right">
                <h2 class="col-lg-12">オブジェクト</h2>
                @for($j = 0;$j != 3;$j++)
                <div class="screen_objs" id="objlists_{{$j}}">
                        @for($i = 0;$i != 3;$i++)
                        <button>
                            <div  onclick="dialogConecterShow(event)" class="row dragitem" id="screen_{{$j}}_obj_{{$i}}"><span>s{{$j}}objrct{{$i}}</span></div>
                        </button>
                        @endfor
                    </div>
                @endfor
            </aside>
        </div>
    </div>
</div>
<div id="dialog" class="dialog">
    <div class="dialogBackground"></div>
    <div class="dialogContent">
        <div class="dialogMsg">
            どの画面につなぎますか？
        </div>
        <hr class="dialog_hr">
        <div>
            <fieldset>
                <select id="conectsel" name="conect" lass="form-control">
                    <option value="tokyo"></option>
                </select>
                <br>
                <input type="button" class="btn btn-primary dialog_btn" value="はい" onclick="" />
                <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('dialog');" />
            </fieldset>
        </div>
    </div>
</div>
<script src="{{ asset('js/transition_edit.js') }}"></script>
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection