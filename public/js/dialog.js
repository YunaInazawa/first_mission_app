// プロジェクト作成 / ユーザ追加
function funcAddUser( users_data, id ) {
    var userName = document.getElementById('add_user').value;
    var userId = 0;

    users_data.forEach(element => {
        if( element['name'] == userName ){
            userId = element['id'];
        }
    });

    var str = '<span>' + userName + '</span>';
    str += '<input type="hidden" name="project_members[]" value="' + userId + '">'
    document.getElementById('join_user').innerHTML += str;
     
    dialogHide(id);
    return;
}

// 画面遷移管理 / 遷移先設定
function funcSetMoveScene(id) {
    var selectValue = document.getElementById('conectsel').value.split(',');

    divId = document.getElementById('divId').value;
    document.getElementById(divId).innerText = selectValue[0];
    
    var decoration_id = divId.substring(divId.lastIndexOf('_')+1);
    document.getElementById('decoration_' + decoration_id).value = selectValue[1];
    
    dialogHide(id);
    return;
}

function func() {
    // ここに「はい」選択時の処理
     
    dialogHide();
    return;
}
function dialogHide( id ) {
    var dialog = document.getElementById(id);
    dialog.style.display = "none";
    return;
}
function dialogShow( id ) {
    // 必要に応じてここに表示前処理(表示メッセージ変更処理など)を入れる
    
    var dialog = document.getElementById(id);
    dialog.style.display = "block";
    return;
}

function dialogConecterShow(event, decoration_id){

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