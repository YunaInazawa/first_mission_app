var tmp = '<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)" class="obj_screen" id="obj_screen_';
var dropObjId = "";
var startX = 0;
var startY = 0;
/*
 * 2.1 ドラッグ&ドロップ
 *****************************************/
// ドラッグ開始時にデータの値を設定する
function DragStart(event) {
    const objectlists = document.getElementsByClassName('screen_objs');
    event.dataTransfer.setData("text", event.target.id);

    for(var i = 0; i < objectlists.length; i++){
        objectlists[i].classList.remove('active_objs');
    }
    document.getElementById('objlists_' + (event.target.id).replace("obj_screen_","")).classList.add('active_objs');

    startY = event.clientY;
    startX = event.clientX;
}
// ドラッグ中位置情報を常に表示させる
function Drag(event) {
    endX = event.clientX;
    endY = event.clientY;
}
// ドロップ時に元のドラッグ値を取得し、現在の要素上に入れ子で保存する
function Drop(event) {
    var id = event.dataTransfer.getData("text");
    if(dropObjId != ""){
        DropAdd(document.getElementById('select_screen').value);
        dropObjId = "";
        return;
    }
    var elm = document.getElementById(id);

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
    document.getElementById('select_screen').value = (event.target.id).replace("drop_screen_","");
}
function DragAddEnd(event){
    event.target.classList.remove('active');
}
function DropAdd(id) {
    // '.canvas'を持つ要素を取得
    const screens = document.getElementById('drop');
    const objectlists = document.getElementsByClassName('screen_objs');
    
    var styleSet = 'style="top:' + (event.clientY - 87) + 'px;left:' + (event.clientX - 383) + 'px;font-size:18px;"';

    screens.innerHTML += tmp + id + '" ' + styleSet +'>' + document.getElementById('drop_screen_' + id).innerText + '</div>';

    for(var i = 0; i < objectlists.length; i++){
        objectlists[i].classList.remove('active_objs');
    }
    document.getElementById('objlists_' + id).classList.add('active_objs');
    document.getElementById('drop_screen_' + id).classList.add('disable');
}
// ブラウザ標準のドロップ動作をキャンセル
function DragOver(event) {
    event.preventDefault();
}
// オブジェクトをクリックしたときに、情報取得表示
function ObjClick(event) {
    const objectlists = document.getElementsByClassName('screen_objs');
    for(var i = 0; i < objectlists.length; i++){
        objectlists[i].classList.remove('active_objs');
    }
    document.getElementById('objlists_' + (event.target.id).replace("obj_screen_","")).classList.add('active_objs');
    
    document.getElementById('select_screen').value = (event.target.id).replace("obj_screen_","");
}

function ClickAdd(event){

}