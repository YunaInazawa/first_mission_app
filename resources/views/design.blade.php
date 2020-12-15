<?php 
$newid = 0;
$tabfst = true;
$tabtargetnum = 0;
$objects = array();
$screenID = 0;
foreach( $scenes_data as $s ){
    foreach( $decorations_data[$s->id] as $d ){
        $objects += array(
            $d->id => array(
                'element' => $d->element->name,
                'screen' => $screenID,
                'sceneId' => $d->scene_id,
                'id' => $d->id,
                'name' => $d->text,
                'height' => $d->height,
                'width' => $d->width,
                'x' => $d->position_x,
                'y' => $d->position_y,
                'fontsize' => $d->font_size,
                's' => $s->id,
            ),
        );
    }
    $screenID = $screenID + 1;
}

?>

<?php
$sample = array('abc','def');//PHPで配列を生成
$varJsSample=json_encode($objects);//JavaScriptに渡すためにjson_encodeを行う
?>

<script type="text/javascript">
var object=JSON.parse('<?php echo $varJsSample; ?>');//jsonをparseしてJavaScriptの変数に代入
</script>

@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/design.css') }}" rel="stylesheet">

<form method="POST" action="{{ route('design_edit', $projectId) }}">
@csrf
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
                                @foreach( $scenes_data as $s )
                                    @if($tabfst == true)
                                        <span class="tab-trigger js-tab-trigger is-active" id="scene_{{ $s->id }}" data-id="tab0<?php echo $s->id;$tabfst = false; ?>">{{ $s->name }}</span>
                                    @else
                                        <span class="tab-trigger js-tab-trigger" id="scene_{{ $s->id }}" data-id="tab0<?php echo $s->id ?>">{{ $s->name }}</span>
                                    @endif
                                @endforeach
                                <?php $tabfst = true; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <aside class="sidemenu sidemenu_left">
                            <h2>オブジェクト</h2>

                                @foreach( $elements_data as $e )
                                @if( $e->name == 'Button' )
                                <button type="button">
                                    <div class="row dragitem" id="drop_btn_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjBtnClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_btn">BUTTON</span><span class="col-lg-8 obj_name">Button</span></div>
                                    <input type="hidden" id="id_new" value="<?php echo $newid; $newid++;?>">
                                </button>
                                @elseif( $e->name == 'RadioButton' )
                                <button type="button">
                                    <div class="row dragitem" id="drop_radio_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjRadioClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_radio">●</span><span class="col-lg-8 obj_name">RadioButton</span></div>
                                </button>
                                @elseif( $e->name == 'TextBox' )
                                <button type="button">
                                    <div class="row dragitem" id="drop_textbox_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjTextBoxClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_textb">abc |</span><span class="col-lg-8 obj_name">TextBox</span></div>
                                </button>
                                @elseif( $e->name == 'Label' )
                                <button type="button">
                                    <div class="row dragitem" id="drop_label_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjLabelClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_label">label</span><span class="col-lg-8 obj_name">Label</span></div>
                                </button>
                                @elseif( $e->name == 'CheckBox' )
                                <button type="button">
                                    <div class="row dragitem" id="drop_checkbox_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjCheckBoxClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_checkb"><label class="fas fa-check"></label></span><span class="col-lg-8 obj_name">CheckBox</span></div>
                                </button>
                                @else
                                    <button type="button">
                                        <div class="row dragitem" id="drop_link_{{ $e->id }}" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" onclick="ObjLinkClick(event, {{ $e->id }})"><span class="col-lg-4 ic ic_link">link</span><span class="col-lg-8 obj_name">Link</span></div>
                                    </button>
                                @endif
                                @endforeach

                                <!-- 仮リンク -->
                                <button type="submit">完了</button>

                                <p>
                                < scenes ><br />
                                @foreach( $scenes_data as $s )
                                {{ $s->id }}{{ $s->name }}<br />
                                    @foreach( $decorations_data[$s->id] as $d )
                                    - {{ $d->id }}-{{ $d->text }}< {{ $d->element->name }} ><br />
                                    - {{ $d->width }} - {{ $d->height }} <br />
                                    - {{ $d->position_x }} - {{ $d->position_y }} <br />
                                    @endforeach
                                @endforeach
                                
                                </p>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content">
                    <!-- 画面一覧の表示 -->
                    @foreach( $scenes_data as $s )
                    @if($tabfst == true)
                        <div id="tab0<?php echo $s->id; $tabfst = false;?>" class="tab-content__item js-tab-target is-active">
                            <div id="canvas_{{ $s->id }}" class="canvas" ondragover="DragOver(event)" ondrop="Drop(event)" >
                            {{ $s->name }}</div>
                        </div>
                    @else
                        <div id="tab0<?php echo $s->id;?>" class="tab-content__item js-tab-target">
                            <div id="canvas_{{ $s->id }}" class="canvas" ondragover="DragOver(event)" ondrop="Drop(event)" >
                            {{ $s->name }}</div>
                        </div>
                    @endif
                    @endforeach

                </div>
            </div>
            <div class="col-lg-2 ">
                <aside class="sidemenu sidemenu_right">
                    <div class="row">
                        <h2 class="col-lg-12">詳細</h2>
                        <table class="col-lg-12 table table-striped table-sm">
                            <tr>
                                <th>表示名</th><td><input class="js-input-elm" id="obj-name" onchange="ChangeText(event)" type="text"></td>
                            </tr>
                            <tr>
                                <th>文字サイズ</th><td><input class="js-input-elm" id="obj-font" type="text" onchange="ChangeText(event)"></td>
                            </tr>
                            <tr>
                                <th>高さ</th><td><input class="js-input-elm" id="obj-height" type="text" onchange="ChangeText(event)"></td>
                            </tr>
                            <tr>
                                <th>幅</th><td><input class="js-input-elm" id="obj-width" type="text" onchange="ChangeText(event)"></td>
                            </tr>
                            <tr>
                                <th>座標X</th><td><input class="js-input-elm" id="obj-x" type="text" onchange="ChangeText(event)"></td>
                            </tr>
                            <tr>
                                <th>座標Y</th><td><input class="js-input-elm" id="obj-y" type="text" onchange="ChangeText(event)"></td>
                            </tr>
                        </table>
                        <button type="button" onClick="deleteObject()">DELETE</button>
                        <input type="text" id="select_screen" value="{{ $scenes_data[0]->id }}" hidden>
                        <input type="text" id="select_obj" value="" hidden>
                    </div>
                    <div class="objectlist ac_menu" id="obj_lists">
                        <span>追加機能一覧</span>
                        <div class="menu construction">
                            @foreach( $scenes_data as $s )
                                <label class="ac_title" id="menu_<?php echo $s->id;?>" for="menu_bar<?php echo $s->id;?>">{{ $s->name }}</label>
                                <input type="checkbox" id="menu_bar<?php echo $s->id;?>" class="accordion checked" onclick="Check(event)"/>
                                <ul id="links<?php echo $s->id;?>">
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</form>

<!-- Script -->
<script src="{{ asset('js/tab.js') }}"></script>
<script src="{{ asset('js/drag_drop.js') }}"></script>

@endsection