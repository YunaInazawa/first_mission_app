var tmp = '<div onclick="ObjClick(event)" ondrag="Drag(event)" draggable="true" ondragstart="DragStart(event)" class="obj_screen" id="obj_screen_';
var dropObjId = "";
var startX = 0;
var startY = 0;

let objListItem = '<li><a onclick="TreeClick(event)" class="obj_list_item" id="obj_list_';
StartFunc();
function StartFunc(){
    const screens = document.getElementById('drop');
    const objectlists = document.getElementsByClassName('screen_objs');

    // 画面ループ (s_id = scene_id)
    for (var s_id in scenesData) {
        var scene = scenesData[s_id];       // 略
        if( scene['position_x'] != null ){
            var styleSet = 'style="top:' + scene['position_y'] + 'px;left:' + scene['position_x'] + 'px;font-size:18px;"';

            screens.innerHTML += tmp + scene['id'] + '" ' + styleSet +'>' + document.getElementById('drop_screen_' + scene['id']).innerText + '</div>';

            for(var i = 0; i < objectlists.length; i++){
                objectlists[i].classList.remove('active_objs');
            }
            document.getElementById('objlists_' + scene['id']).classList.add('active_objs');
            document.getElementById('drop_screen_' + scene['id']).classList.add('disable');
            
            document.getElementById('menu_btn_' + scene['id']).classList.add('disable');
            // 要素ループ (e_id = element_id)
            
        }

    }
    for (var s_id in object) {
        for(var e_id in object[s_id]){
            var element = object[s_id][e_id];
            /* 要素が「Button」のとき */
            if( element['element_id'] == elementsId['Button'] || element['element_id'] == elementsId['Link']){    
                /* 遷移先が設定されているとき */
                if(element['move_scene_id'] != null){

                    // hr 作成
                    screens.innerHTML += '<hr class="conecter j_' + element['scene_id'] + ' f_' + element['move_scene_id'] + ' " id="t_' + element['scene_id'] + '_to_t_' + element['move_scene_id'] + '">';
                    Conect(element['move_scene_id'],element['scene_id'],'t_' + element['scene_id'] + '_to_t_' + element['move_scene_id'])
                
                }
            }
        }
    }
    
}

// scene_{id} に登録（ POST で送る ）
function createPostSceneData(id, x, y){
    var hide_name = 'scene_' + id.replace("obj_screen_","");
    var value_str = y + ',' + x;
    document.getElementById(hide_name).value = value_str;

}

/**
 *  送られた id の画面上にあるオブジェクトの遷移先を削除
 */
function deleteTransition( scene_id ) {
    var objects = document.getElementById('objects_' + scene_id);
    alert('screen_' + scene_id + '_obj_');
}

/**
 * シーン削除
*/
function deleteScene( scene_id ) {

    // 左側の scene 有効にする
    document.getElementById('drop_screen_' + scene_id).classList.remove('disable');
    document.getElementById('menu_btn_' + scene_id).classList.remove('disable');
    // 未選択状態にする
    const objectlists = document.getElementsByClassName('screen_objs');
    for(var i = 0; i < objectlists.length; i++){
        objectlists[i].classList.remove('active_objs');
    }

    // 画面削除
    document.getElementById('obj_screen_' + scene_id).remove();

    // scene 座標削除
    document.getElementById('scene_' + scene_id).value = ',';

    var objects = document.getElementsByClassName('this_scene_id_' + scene_id);
    for( var i = 0; i < objects.length; i++ ){

        // null
        objects[i].value = null;

        // name : ---
        var object_id = objects[i].id.replace('decoration_', '');
        var str = document.getElementById('screen_' + scene_id + '_obj_' + object_id).innerText;
        var valueStr = str.substring(0, str.indexOf(" ")) + ' : ---';
        document.getElementById('screen_' + scene_id + '_obj_' + object_id).innerText = valueStr;
    }

}

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

    // scene_{id} に登録（ POST で送る ）
    createPostSceneData(id, ((document.getElementById(id).style.top).replace("px","") - (startY - endY)), ((document.getElementById(id).style.left).replace("px","") - (startX - endX)))

    //alert("x:" + xxx + ",y:" + yyy + ",w:" + xx + ",h:" + yy);
    document.getElementById(id).classList.add('is-drop');
    document.getElementById(id).style.top = ((document.getElementById(id).style.top).replace("px","") - (startY - endY)) + "px" ;
    document.getElementById(id).style.left = ((document.getElementById(id).style.left).replace("px","") - (startX - endX)) + "px" ;
    event.currentTarget.appendChild(elm);
    event.preventDefault();
    MoveConect(id.replace("obj_screen","") + " ");
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
    document.getElementById('menu_btn_' + id).classList.add('disable');

    // scene_{id} に登録（ POST で送る ）
    createPostSceneData(id, (event.clientY - 87), (event.clientX - 383))
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

function MoveConect(dropid){
    // タブメニュークラス'.js-tab-trigger'を持つ要素を取得
    const conecters = document.querySelectorAll('.conecter');
    var str = "";
    for(let i = 0; i < conecters.length; i++){
        str = String(conecters[i].classList);
        if(str.indexOf(dropid) != -1){
    //        alert("jump:" + str.substr(11,parseInt(str.indexOf('f_'))-12) +" form:" + str.substr(str.indexOf('f_')+2, (str.substr(str.indexOf('f_')+2)).indexOf(" ") ) + " hr:" + conecters[i].id );
            Conect(str.substr(11,parseInt(str.indexOf('f_'))-12),str.substr(str.indexOf('f_')+2, (str.substr(str.indexOf('f_')+2)).indexOf(" ") ),conecters[i].id)
        }
    }
}

function Conect(jumpId,formerId,hrConect){
    //alert("HEY")
    var formCenterX = (document.getElementById('obj_screen_' + formerId).style.left).replace("px","");
    var formCenterY = (document.getElementById('obj_screen_' + formerId).style.top).replace("px","");
    var jumpCenterX = (document.getElementById('obj_screen_' + jumpId).style.left).replace("px","");
    var jumpCenterY = (document.getElementById('obj_screen_' + jumpId).style.top).replace("px","");
    //alert("FX:" + formCenterX + " FY:" + formCenterY + " JX:" +jumpCenterX+" JY:" +jumpCenterY)
    var conTop = 0;
    var conLeft = 0;
    var conWidth = 0;
    var conHeight = 0;
    var R = 0;
    var conDeg = 0;
    var weveTop = 0;
    var weveLeft = 0;
    if(formCenterX > jumpCenterX){
        conTop = parseFloat(jumpCenterY) + 42.5;
        conLeft = parseFloat(jumpCenterX) + 65;
        conWidth = formCenterX - jumpCenterX;
        if(parseFloat(formCenterY) > parseFloat(jumpCenterY)){
            conHeight = formCenterY - jumpCenterY;
            R = Math.atan2(conHeight,conWidth);
            conDeg = R*180/Math.PI
            conWidth = conWidth / Math.cos (R);
            weveTop = (conWidth / 2) * Math.sin (R);
            weveLeft = (conWidth /2) - ((conWidth / 2) * Math.cos (R));
            //weveLeft = (conHeight / 2) * Math.tan (R);
        }else{
            conHeight = jumpCenterY - formCenterY;
            R = Math.atan2(conHeight,conWidth);
            conDeg = (R*180/Math.PI)*-1
            conWidth = conWidth / Math.cos (R);
            weveTop = ((conWidth / 2) * Math.sin (R))*-1;
            weveLeft = (conWidth / 2) - ((conWidth / 2) * Math.cos (R));
            //weveLeft = (conHeight / 2) * Math.tan (R);
        }
        document.getElementById(hrConect).style.top = (parseFloat(jumpCenterY) + 42.5 + weveTop) + "px";
        document.getElementById(hrConect).style.left = (parseFloat(jumpCenterX) + 65 - weveLeft) + "px";
        document.getElementById(hrConect).style.width = (conWidth) + "px";
        document.getElementById(hrConect).style.transform = "rotate(" + conDeg + "deg)";
    }else{

        conTop = parseFloat(formCenterY) + 42.5;
        conLeft = parseFloat(formCenterX) + 65;
        conWidth = jumpCenterX - formCenterX;
        if(parseFloat(formCenterY) > parseFloat(jumpCenterY)){
            conHeight = formCenterY - jumpCenterY;
            R = Math.atan2(conHeight,conWidth);
            conDeg =(R*180/Math.PI)* -1
            conWidth = conWidth / Math.cos (R);
            weveTop = ((conWidth / 2) * Math.sin (R))*-1;
            weveLeft = (conWidth /2) - ((conWidth / 2) * Math.cos (R));
            //weveLeft = (conHeight / 2) * Math.tan (R);
        }else{
            conHeight = jumpCenterY - formCenterY;
            R = Math.atan2(conHeight,conWidth);
            //alert(conHeight + ":" + conWidth + ":" + hrConect)
            conDeg = R*180/Math.PI
            
            conWidth = conWidth / Math.cos (R);
            weveTop = (conWidth / 2) * Math.sin (R);
            weveLeft = (conWidth / 2) - ((conWidth / 2) * Math.cos (R));
        }
        
        document.getElementById(hrConect).style.top = (parseFloat(formCenterY) + 42.5 + weveTop) + "px";
        document.getElementById(hrConect).style.left = (parseFloat(formCenterX) + 65 - weveLeft) + "px";
        document.getElementById(hrConect).style.width = (conWidth) + "px";
        document.getElementById(hrConect).style.transform = "rotate(" + conDeg + "deg)";
    }
}

// 画面遷移管理 / 遷移先設定
function funcSetMoveScene2(id) {
    var selectValue = document.getElementById('conectsel').value.split(',');

    divId = document.getElementById('divId').value;
    document.getElementById(divId).innerText = selectValue[0];
    
    var decoration_id = divId.substring(divId.lastIndexOf('_')+1);
    document.getElementById('decoration_' + decoration_id).value = selectValue[1];
    
    dialogHide2('dialog');
    return;
}
function dialogHide2( id ) {
    var dialog = document.getElementById(id);
    dialog.style.display = "none";
    return;
}


function dialogConecterShow2(event, decoration_id,s_id){

    // 選択している画面id
    var id = document.getElementById('select_screen').value;
    
    // 全ての画面名
    const screenNames = document.getElementsByClassName('screennames');
    
    // select の option を全削除
    document.getElementById('conectsel').innerHTML = '';

    // 選択したオブジェクト名
    var str = event.target.innerText;

    // option の valueStr / 選択したオブジェクト名だけ抽出
    var valueStr = str.substring(0, str.indexOf(" ")) + ' : ---,null';

    // 「---」を option に追加
    document.getElementById('conectsel').innerHTML += '<option value="' + valueStr + '">' + '---' + '</option>'
    
    // 現在、遷移先に設定されている画面id
    var nowScreenId = document.getElementById('decoration_' + decoration_id).value;

    /* 画面の数だけ繰り返す */
    for(var i = 0; i < screenNames.length; i++){

        // 画面id
        var scene_id = screenNames[i].id.replace('drop_screen_', '');
        
        /* 自分が置かれている画面以外の場合 */
        if(scene_id != id){

            // option の valueStr / 表示名を作る
            var valueStr = str.substring(0, str.indexOf(" ")) + ' : ';
            valueStr += screenNames[i].innerText + ',' + scene_id;

            /* 現在、遷移先に設定されている画面を初期値に設定する */
            if( nowScreenId == scene_id ){
                document.getElementById('conectsel').innerHTML += '<option value="' + valueStr + '" selected>' + screenNames[i].innerText + '</option>'
            }else{
                document.getElementById('conectsel').innerHTML += '<option value="' + valueStr + '">' + screenNames[i].innerText + '</option>'
            }
            
        }
    }

    // 選択したオブジェクトid を保存
    document.getElementById('divId').value = event.target.id;

    var dialog = document.getElementById('dialog');
    dialog.style.display = "block";
    return;
}