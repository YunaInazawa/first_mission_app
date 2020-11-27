<script type="text/javascript">
    var scenesData = @json($scenesData);
    var elementsId = @json($elementsId);
</script>

@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/design.css') }}" rel="stylesheet">
<link href="{{ asset('css/transition_edit.css') }}" rel="stylesheet">

<form method="POST" action="{{ route('transition_update', $projectId) }}">
@csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <aside class="sidemenu sidemenu_left">
                    <h2>スクリーン</h2>
                    @foreach( $scenesData as $scene )
                    <button type="button">
                        <div class="row dragitem screennames" ondragend="DragAddEnd(event)" ondragstart="DrapAddStart(event)" draggable="true" id="drop_screen_{{ $scene->id }}"><span>{{ $scene->name }}</span></div>
                    </button>
                    <input type="hidden" id="scene_{{ $scene->id }}" name="scenes[{{ $scene->id }}][]" value="{{ $scene->position_x }}, {{ $scene->position_y }}">
                    @endforeach
                    
                    <!-- 仮リンク -->
                    <button type="submit">完了</button>

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
                    @foreach( $scenesData as $scene )
                    <div class="screen_objs" id="objlists_{{ $scene->id }}">
                            @foreach( $objects[$scene->id] as $object )
                            @if( in_array($object->element_id, $elementsId, true) )
                            <button type="button">
                                <div onclick="dialogConecterShow(event, {{ $object->id }})" class="row dragitem" id="screen_{{ $scene->id }}_obj_{{ $object->id }}">{{ $object->text }} : {{ ($object->move_scene->name == null) ? '---' : $object->move_scene->name }}</div>
                            </button>
                            <input type="hidden" id="decoration_{{ $object->id }}" name="decorations[{{ $object->id }}][]" value="{{ $object->move_scene_id }}">
                            @endif
                            @endforeach
                        </div>
                    @endforeach
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
                    <input type="hidden" id="divId" value="">
                    <input type="button" class="btn btn-primary dialog_btn" value="はい" onclick="funcSetMoveScene('dialog')" />
                    <input type="button" class="btn btn-primary dialog_btn" value="いいえ" onclick="dialogHide('dialog');" />
                </fieldset>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/transition_edit.js') }}"></script>
<script src="{{ asset('js/dialog.js') }}"></script>

@endsection