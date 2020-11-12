/*****************************************
 * design画面のオブジェクト追加、詳細変更js
 * 1.共通の変数初期化
 * 2.ドラッグ&ドロップ
 *  2.1 ドラッグ&ドロップ
 *  2.2 選択オブジェクトの情報取得・表示用関数
 * 3.新規オブジェクト追加
 * 4.右メニューの情報変更
 *****************************************/

/*****************************************
 * 1.共通の変数を初期化
 *****************************************/
// 右メニューのinnputオブジェクトを全て取得(名前、文字、高さ、幅、ｘ、ｙ)
const elms = document.querySelectorAll('.js-input-elm');
// 追加要素の共通部分格納
let tmpObj = '<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)"  style="top:0;left:0;font-size:18px;" class="draggable obj ';



/*****************************************
 * 2.ドラッグ&ドロップ
 *****************************************/
/*
 * 2.1 ドラッグ&ドロップ
 *****************************************/
// ドラッグ開始時にデータの値を設定する
function DragStart(event) {
    event.dataTransfer.setData("text", event.target.id);
    SelectSet(event); // オブジェクトの情報を取得し、右メニューに表示
}
// ドラッグ中位置情報を常に表示させる
function Drag(event) {
    elms[4].value = event.clientX - 383;
    elms[5].value = event.clientY - 87;
}
// ドロップ時に元のドラッグ値を取得し、現在の要素上に入れ子で保存する
function Drop(event) {
    var id = event.dataTransfer.getData("text");
    var elm = document.getElementById(id);

    document.getElementById(id).classList.add('is-drop');
    document.getElementById(id).style.top = (event.clientY - 87) + "px" ;
    document.getElementById(id).style.left = (event.clientX - 383) + "px" ;
    event.currentTarget.appendChild(elm);
    event.preventDefault();
}
// ブラウザ標準のドロップ動作をキャンセル
function DragOver(event) {
    event.preventDefault();
}
// オブジェクトをクリックしたときに、情報取得表示
function ObjClick(event) {
    SelectSet(event);
}

/*
 * 2.2 選択オブジェクトの情報取得・表示用関数
 *****************************************/
function SelectSet(event){
    var selObjId = event.target.id;
    if(-1 == selObjId.indexOf('obj')){
        selObjId = "obj_" + selObjId;
    }
    var selObj = document.getElementById(selObjId);

    // 選択したオブジェクトのIDを取得
    document.getElementById('select_obj').value = selObjId;
    
    // 選択したオブジェクトの情報を右メニューに表示
    elms[4].value = (selObj.style.left).replace("px","");       // X座標
    elms[5].value = (selObj.style.top).replace("px","");        // Y座標
    elms[0].value = selObj.innerText;                           // 名前
    elms[1].value = (selObj.style.fontSize).replace("px","");   // 文字
    elms[2].value = selObj.clientHeight;                        // 高さ
    elms[3].value = selObj.clientWidth;                         // 幅

    // 右メニューの全てのobj-disableクラスを削除
    for (let i = 0; i < elms.length; i++) {
        elms[i].classList.remove('obj_disable');
    }
    
    // 選択した、オブジェクトの種類によって、無効、有効を切り替える
    if (selObjId.indexOf('btn') == -1){
        elms[2].classList.add('obj_disable');
        elms[3].classList.add('obj_disable');
    }
    if (selObjId.indexOf('textbox') != -1){
        elms[0].classList.add('obj_disable');
    }
}


/**
 * 
 * @param {<?php

$json_array = json_encode($php_array);

?>
JavaScript側では以下のように受け取ります。

JavaScript

let js_array = <?php echo $json_array; ?>
} event 
 */
/*****************************************
 * 3.新規オブジェクト追加
 *****************************************/
function ObjBtnClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_btn" id="obj_btn_' + document.getElementById('id_btn').value + '">BUTTON</div>');
    document.getElementById('id_btn').value = Number(document.getElementById('id_btn').value) + 1;
}

function ObjLabelClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_label" id="obj_label_' + document.getElementById('id_label').value +'">label</div>');
    document.getElementById('id_label').value = Number(document.getElementById('id_label').value) + 1;
}

function ObjRadioClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_radio" id="obj_radio_' + document.getElementById('id_radio').value + '"><input id="radio_1" type="radio">Radio</div>');
    document.getElementById('id_radio').value = Number(document.getElementById('id_radio').value) + 1;
}

function ObjTextBoxClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_textbox" id="obj_textbox_' + document.getElementById('id_text').value + '"><input id="textbox_1" type="text"></div>');
    document.getElementById('id_text').value = Number(document.getElementById('id_text').value) + 1;
}

function ObjCheckBoxClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_checkbox" id="obj_checkbox_' + document.getElementById('id_check').value + '"><input id="checkbox_1" type="checkbox">CheckBox</div>');
    document.getElementById('id_check').value = Number(document.getElementById('id_check').value) + 1;
}



/*****************************************
 * 4.右メニューの情報変更
 *****************************************/
function ChangeText(event){
    var selObj = document.getElementById('select_obj').value;
    var evId = event.target.id;
    if(evId == 'obj-name'){
        document.getElementById(selObj).innerText = elms[0].value;
    }else if(evId == 'obj-height'){
        document.getElementById(selObj).style.height = elms[2].value + "px";
    }else if(evId == 'obj-width'){
        document.getElementById(selObj).style.width = "10px";
    }else if(evId == 'obj-x'){
        document.getElementById(selObj).style.left = elms[4].value + "px";
    }else if(evId == 'obj-y'){
        document.getElementById(selObj).style.top = elms[5].value + "px";
    }else if(evId == 'obj-font'){
        document.getElementById(selObj).style.fontSize = elms[1].value + "px";
        elms[2].value = document.getElementById(selObj).clientHeight;
        elms[3].value = document.getElementById(selObj).clientWidth;
    }
}
