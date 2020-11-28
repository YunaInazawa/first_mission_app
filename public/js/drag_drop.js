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
let tmpObj = '<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)" style="top:0;left:0;font-size:18px;" class="draggable obj ';
var droptmpObj ='<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)" class="draggable obj ';
let alreadyTmpObj = '<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)" class="draggable obj ';
let objListItem = '<li><a onclick="TreeClick(event)" class="obj_list_item" id="obj_list_';
var dropObjId = "";
var startY = 0;
var startX = 0;
var endY = 0;
var endX = 0;
StartFunc();
function StartFunc(){
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    let key = Object.keys(object);
    for (var k in key) {
        var objitemset = '';
        var styleSet = 'style="top: ' + object[key[k]]['y'] + 'px; left: ' + object[key[k]]['x'] + 'px; font-size: 18px; height: ' + object[key[k]]['height'] + 'px; width: ' + object[key[k]]['width'] + 'px;"';

        if(object[key[k]]['element'] == "Button"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_btn"' + styleSet +' id="obj_already_btn_' + key[k] + '">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_btn_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_btn_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "CheckBox"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_checkbox"' + styleSet +' id="obj_already_checkbox_' + key[k] + '"><input id="already_checkbox_' + key[k] + '" type="checkbox">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_checkbox_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_checkbox_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "Label"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_label"' + styleSet +' id="obj_already_label_' + key[k] + '">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_label_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_label_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "RadioButton"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_radio"' + styleSet +' id="obj_already_radio_' + key[k] + '"><input id="already_radio_' + key[k] + '" type="radio">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_radio_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_radio_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "TextBox"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_textbox"' + styleSet +' id="obj_already_textbox_' + key[k] + '"><input id="already_textbox_' + key[k] + '" type="text"></div>';
            objitemset = objListItem + 'alr_textbox_' + key[k] + '">' + object[key[k]]['element'] + key[k];
        }

        // hidden を作成（ POST で送信 ）
        var hideName = 'decorations[' + object[key[k]]['id'] + ']';
        var valueStr = object[key[k]]['name'] + ',' + 
            object[key[k]]['fontsize'] + ',' + 
            object[key[k]]['width'] + ',' + 
            object[key[k]]['height'] + ',' + 
            object[key[k]]['x'] + ',' + 
            object[key[k]]['y'];
        var hideStr = '<input type="hidden" name="' + hideName + '" value="' + valueStr + '">';

        document.getElementById('links'+object[key[k]]['s']).innerHTML += objitemset + '</a></li>' + hideStr;
    }
}
function AddObjList(addobj,addid){
    const tabTargets = document.querySelectorAll('.js-tab-target');
    var num = document.getElementById( "select_screen").value;
    var objitemset = objListItem + addid + '_' + document.getElementById('id_new').value + '"><span class="new_c">●</span><span class="new_p">＋</span>' + addobj + document.getElementById('id_new').value;
    if(addobj != "TextBox"){
        objitemset += '-<span id="list_' + addid +'_' + document.getElementById('id_new').value +'">' + addobj + '</span>';
    }
    document.getElementById('links' + (tabTargets[num].id).replace("tab0","")).innerHTML += objitemset + '</a></li>';
}

/*****************************************
 * 2.ドラッグ&ドロップ
 *****************************************/
/*
 * 2.1 ドラッグ&ドロップ
 *****************************************/
// ドラッグ開始時にデータの値を設定する
function DragStart(event) {
    event.dataTransfer.setData("text", event.target.id);
    SelectSet(event.target.id); // オブジェクトの情報を取得し、右メニューに表示
    startY = event.clientY;
    startX = event.clientX;
}
// ドラッグ中位置情報を常に表示させる
function Drag(event) {
    endX = event.clientX;
    endY = event.clientY;
    elms[4].value = (event.target.style.left).replace("px","") - (startX - endX);
    elms[5].value = (event.target.style.top).replace("px","") - (startY - endY);
}
// ドロップ時に元のドラッグ値を取得し、現在の要素上に入れ子で保存する
function Drop(event) {
    var id = event.dataTransfer.getData("text");
    if(dropObjId != ""){
        DropAdd(dropObjId);
        dropObjId = "";
        return;
    }
    var elm = document.getElementById(id);
    var x = event.clientX;
    var y = event.clientY;
    var width = event.target.offsetLeft;
    var height =event.target.offsetTop;
    // 要素の位置座標を取得
    var clientRect = event.target.getBoundingClientRect() ;
    var clientRect2 = document.getElementById(id).getBoundingClientRect() ;

    // 画面の左端から、要素の左端までの距離
    var xxx = clientRect2.left ;
    
    // 画面の上端から、要素の上端までの距離
    var yyy = clientRect2.top ;    // 画面の左端から、要素の左端までの距離
    var xx = clientRect.left ;
    
    // 画面の上端から、要素の上端までの距離
    var yy = clientRect.top ;
    //alert("x:" + xxx + ",y:" + yyy + ",w:" + xx + ",h:" + yy);
    document.getElementById(id).classList.add('is-drop');
    document.getElementById(id).style.top = ((document.getElementById(id).style.top).replace("px","") - (startY - endY)) + "px" ;
    document.getElementById(id).style.left = ((document.getElementById(id).style.left).replace("px","") - (startX - endX)) + "px" ;
    event.currentTarget.appendChild(elm);
    event.preventDefault();
}
function DrapAddStart(event) {
    event.target.classList.add('active');
    dropObjId = event.target.id;
}
function DragAddEnd(event){
    
    event.target.classList.remove('active');
}
function DropAdd(id) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    var styleSet = 'style="top:' + (event.clientY - 87) + 'px;left:' + (event.clientX - 383) + 'px;font-size:18px;"';
    // drop_radio → obj_radio_0
    if(dropObjId.indexOf("btn") != -1){
        tabTargets[num].innerHTML += droptmpObj + 'obj_btn" id="obj_btn_' + document.getElementById('id_new').value + '"' + styleSet + '>Button</div>';
        AddObjList('Button','btn');
        SelectSet('obj_btn_' + document.getElementById('id_new').value);
    }else if(dropObjId.indexOf("checkbox") != -1){
        tabTargets[num].innerHTML += droptmpObj + 'obj_checkbox" id="obj_checkbox_' + document.getElementById('id_new').value + '"' + styleSet + '><input id="checkbox_1" type="checkbox">CheckBox</div>';
        AddObjList('CheckBox','checkbox');
        SelectSet('obj_checkbox_' + document.getElementById('id_new').value);
    }else if(dropObjId.indexOf("label") != -1){
        tabTargets[num].innerHTML += droptmpObj + 'obj_label" id="obj_label_' + document.getElementById('id_new').value +'"' + styleSet + '>Label</div>';
        AddObjList('Label','label');
        SelectSet('obj_label_' + document.getElementById('id_new').value);
    }else if(dropObjId.indexOf("radio") != -1){
        tabTargets[num].innerHTML += droptmpObj + 'obj_radio" id="obj_radio_' + document.getElementById('id_new').value + '"' + styleSet + '><input id="radio_1" type="radio">RadioButton</div>';
        AddObjList('RadioButton','radio');
        SelectSet('obj_radio_' + document.getElementById('id_new').value);
    }else if(dropObjId.indexOf("textbox") != -1){
        tabTargets[num].innerHTML += droptmpObj + 'obj_textbox" id="obj_textbox_' + document.getElementById('id_new').value + '"' + styleSet + '><input id="textbox_1" type="text"></div>';
        AddObjList('TextBox','textbox');
        SelectSet('obj_textbox_' + document.getElementById('id_new').value);
    }
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
    
}
// ブラウザ標準のドロップ動作をキャンセル
function DragOver(event) {
    event.preventDefault();
}
// オブジェクトをクリックしたときに、情報取得表示
function ObjClick(event) {
    SelectSet(event.target.id);
}

/*
 * 2.2 選択オブジェクトの情報取得・表示用関数
 *****************************************/
function SelectSet(id){
    var selObjId = id;
    if(-1 == selObjId.indexOf('obj')){
        selObjId = "obj_" + selObjId;
    }
    selObjId = selObjId.replace("list_","");
    selObjId = selObjId.replace("alr_","already_");
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
    $(tabTargets[num]).append(tmpObj + 'obj_btn" id="obj_btn_' + document.getElementById('id_new').value + '">' + event.target.innerText + '</div>');
    AddObjList('Button','btn');
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
}

function ObjLabelClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_label" id="obj_label_' + document.getElementById('id_new').value +'">' + event.target.innerText + '</div>');
    AddObjList('Label','label');
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
}

function ObjRadioClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_radio" id="obj_radio_' + document.getElementById('id_new').value + '"><input id="radio_1" type="radio">' + event.target.innerText + '</div>');
    AddObjList('RadioButton','radio');
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
}

function ObjTextBoxClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_textbox" id="obj_textbox_' + document.getElementById('id_new').value + '"><input id="textbox_1" type="text"></div>');
    AddObjList('TextBox','textbox');
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
}

function ObjCheckBoxClick(event) {
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.canvas');
    var num = document.getElementById( "select_screen").value;
    $(tabTargets[num]).append(tmpObj + 'obj_checkbox" id="obj_checkbox_' + document.getElementById('id_new').value + '"><input id="checkbox_1" type="checkbox">' + event.target.innerText + '</div>');
    AddObjList('CheckBox','checkbox');
    document.getElementById('id_new').value = Number(document.getElementById('id_new').value) + 1;
}



/*****************************************
 * 4.右メニューの情報変更
 *****************************************/
function ChangeText(event){
    var selObj = document.getElementById('select_obj').value;
    var evId = event.target.id;
    if(evId == 'obj-name'){
        document.getElementById(selObj).innerText = elms[0].value;
        var sellist = '';
        if(selObj.indexOf('already') != -1){
            sellist = selObj.replace("obj_already","list_alr");
        }else{
            sellist = selObj.replace("obj","list");
        }
        document.getElementById(sellist).innerText = elms[0].value;
    }else if(evId == 'obj-height'){
        document.getElementById(selObj).style.height = elms[2].value + "px";
    }else if(evId == 'obj-width'){
        document.getElementById(selObj).style.width = elms[3].value + "px";
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


function Check(event){
    var checkac = (event.target.id).replace("menu_bar","links");
    if(document.getElementById(checkac).classList == ""){
        document.getElementById(checkac).classList.add('checked');
    }else{
        document.getElementById(checkac).classList.remove('checked');
    }
}


function TreeClick(event){
    SelectSet(event.target.id);
}