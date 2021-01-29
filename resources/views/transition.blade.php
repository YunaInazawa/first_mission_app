<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" id="svg-bg">
    <path d="M0,0 v50 q10,10 20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="#FFF"></path>
</svg>
<?php
$newid = 0;
$tabfst = true;
$tabtargetnum = 0;
// $objects = array();
$screenID = 0;
// $objects += array(
//     '1' => array(
//         'element' => 'Buttom',
//         'screen' => '0',
//         'name' => 'BLUE',
//         'height' => '37',
//         'width' => '63',
//         'x' => '610',
//         'y' => '737',
//         'fontsize' => '18',
//         'jumpid' => '1',
//     ),
//     '2' => array(
//         'element' => 'Buttom',
//         'screen' => '1',
//         'name' => 'Yellow',
//         'height' => '37',
//         'width' => '72',
//         'x' => '199',
//         'y' => '527',
//         'fontsize' => '18',
//         'jumpid' => '2',
//     ),
//     '3' => array(
//         'element' => 'Buttom',
//         'screen' => '2',
//         'name' => 'red',
//         'height' => '37',
//         'width' => '44',
//         'x' => '809',
//         'y' => '387',
//         'fontsize' => '18',
//         'jumpid' => '0',
//     ),
// );
$topLeft = [];
$isfirst = [];
$cnt = 0;
foreach ( $scenesData as $scene) {
    $topLeft[$cnt][0] = ($scene->position_y)*10;
    $topLeft[$cnt][1] = ($scene->position_x)*10;
    if($scene->is_first == 1){
        $isfirst[0] = (($scene->position_y)*-10)+85;
        $isfirst[1] = (($scene->position_x)*-10)+200;
    }
    $cnt++;
}
$cnt = 0;
/*
foreach( $scenes_data as $s ){
    foreach( $decorations_data[$s->id] as $d ){
        $objects += array(
            $d->id => array(
                'element' => $d->element->name,
                'screen' => $screenID,
                'name' => $d->text,
                'height' => $d->height,
                'width' => $d->width,
                'x' => $d->position_x,
                'y' => $d->position_y,
                'fontsize' => '18',
                's' => $s->id,
            ),
        );
    }
    $screenID = $screenID + 1;
}*/
?>


<?php
$sample = array('abc','def');//PHPで配列を生成
$varJsSample=json_encode($objects);//JavaScriptに渡すためにjson_encodeを行う
$varJsSa=json_encode($isfirst);//JavaScriptに渡すためにjson_encodeを行う
?>

<script type="text/javascript">
// var object=JSON.parse('<?php //echo $varJsSample; ?>');//jsonをparseしてJavaScriptの変数に代入
var object = @json($objects);
var isfirst = @json($isfirst);
var elementsId = @json($elementsId);
</script>

@extends('layouts.app_header')

@section('content')

<!-- Stylesheet -->
<link href="{{ asset('css/app_user.css') }}" rel="stylesheet">
<link href="{{ asset('css/transition.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="screens" id="screenlist" style="top:<?= $isfirst[0] ?>px;left:<?= $isfirst[1] ?>px;">
            @foreach( $scenesData as $scene )
                <div class="screen" id="t_{{ $scene->id }}" style="top:<?php echo $topLeft[$cnt][0]; ?>px;left:<?php echo $topLeft[$cnt][1];$cnt++; ?>px;" ><div class="scene_titles">{{ $scene->name }}</div></div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script -->
<script src="{{ asset('js/dialog.js') }}"></script>
<script src="{{ asset('js/transition.js') }}"></script>

@endsection
