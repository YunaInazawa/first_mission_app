<?php 
$btn = 0;
$radio = 0;
$text = 0;
$label = 0;
$check = 0;
?>
@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/design.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="row">
                <div class="col-lg-2">
                    <div id="nav-drawer">
                        <input id="nav-input" type="checkbox" class="nav-unshown">
                        <label id="nav-open" class="fas fa-bars" for="nav-input"></label>
                        <label class="nav-unshown" id="nav-close" for="nav-input"></label>
                        <div id="nav-content">
                            <span class="tab-trigger js-tab-trigger is-active" data-id="tab01">KINOKOLIST</span>
                            <span class="tab-trigger js-tab-trigger" data-id="tab02">TOP</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <aside class="sidemenu sidemenu_left">
                        <h2>オブジェクト</h2>
                            <button>
                                <div class="row" onclick="ObjBtnClick(event)"><span class="col-lg-4 ic ic_btn">BUTTON</span><span class="col-lg-8 obj_name">Button</span></div>
                                <input type="hidden" id="id_btn" value="<?php echo $btn; $btn++;?>">
                            </button>
                            <button>
                                <div class="row" onclick="ObjRadioClick(event)"><span class="col-lg-4 ic ic_radio">●</span><span class="col-lg-8 obj_name">RadioButton</span></div>
                                <input type="hidden" id="id_radio" value="<?php echo $radio; $radio++;?>">
                            </button>
                            <button>
                                <div class="row" onclick="ObjTextBoxClick(event)"><span class="col-lg-4 ic ic_textb">abc |</span><span class="col-lg-8 obj_name">TextBox</span></div>
                                <input type="hidden" id="id_text" value="<?php echo $text; $text++;?>">
                            </button>
                            <button>
                                <div class="row" onclick="ObjLabelClick(event)"><span class="col-lg-4 ic ic_label">label</span><span class="col-lg-8 obj_name">Label</span></div>
                                <input type="hidden" id="id_label" value="<?php echo $label; $label++;?>">
                            </button>
                            <button>
                                <div class="row" onclick="ObjCheckBoxClick(event)"><span class="col-lg-4 ic ic_checkb"><label class="fas fa-check"></label></span><span class="col-lg-8 obj_name">CheckBox</span></div>
                                <input type="hidden" id="id_check" value="<?php echo $check; $check++;?>">
                            </button>
                    </aside>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content">
                <!-- 画面一覧の表示 -->
                <div id="tab01" class="tab-content__item js-tab-target is-active">

                    <div id="drop" class="canvas" ondragover="DragOver(event)" ondrop="Drop(event)" >
                    </div>
                </div>
                <!-- 画面遷移が表示される -->
                <div id="tab02" class="tab-content__item js-tab-target">
                    <div id="drop" class="canvas" ondragover="DragOver(event)" ondrop="Drop(event)" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 ">
            <aside class="sidemenu sidemenu_right">
                <div class="row">
                    <h2 class="col-lg-12">詳細</h2>
                    <hr class="col-lg-12 sidemenu_hr">
                    <input type="text" id="select_screen" value="0" hidden>
                    <input type="text" id="select_obj" value="" hidden>
                    <p class="col-lg-3">表示名</p><div class="v_line_fix"></div>
                    <input class="col-lg-8 js-input-elm" id="obj-name" onchange="ChangeText(event)" type="text">
                    <hr class="col-lg-12 sidemenu_hr">
                    <span class="col-lg-3">文字サイズ</span><div class="v_line_fix"></div>
                    <input class="col-lg-2 js-input-elm" id="obj-font" type="text" onchange="ChangeText(event)">
                    <hr class="col-lg-12 sidemenu_hr">
                    <span class="col-lg-3">高さ</span><div class="v_line_fix"></div><input class="col-lg-2 js-input-elm" id="obj-height" type="text" onchange="ChangeText(event)">
                    <span class="col-lg-3">幅</span><div class="v_line_fix"></div><input class="col-lg-2 js-input-elm" id="obj-width" type="text" onchange="ChangeText(event)">
                    <hr class="col-lg-12 sidemenu_hr">
                    <span class="col-lg-3">座標X</span><div class="v_line_fix"></div><input class="col-lg-2 js-input-elm" id="obj-x" type="text" onchange="ChangeText(event)">
                    <span class="col-lg-3">座標Y</span><div class="v_line_fix"></div><input class="col-lg-2 js-input-elm" id="obj-y" type="text" onchange="ChangeText(event)">
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/tab.js') }}"></script>
<script src="{{ asset('js/drag_drop.js') }}"></script>

@endsection