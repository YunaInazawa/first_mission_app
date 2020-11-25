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
    alert(document.getElementById('conectsel').value);
    
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

function dialogConecterShow(event){
    var id = document.getElementById('select_screen').value;
    
    const screenNames = document.getElementsByClassName('screennames');
    
    document.getElementById('conectsel').innerHTML = '';

    var str = event.target.innerText;
    var valueStr = str.substring(0, str.indexOf(" ")) + ' : ';
    document.getElementById('conectsel').innerHTML += '<option value="' + (valueStr + '---') + '">' + '---' + '</option>'


    for(var i = 0; i < screenNames.length; i++){
        var scene_id = screenNames[i].id.replace('drop_screen_', '');

        if(scene_id != id){
            valueStr += screenNames[i].innerText;

            document.getElementById('conectsel').innerHTML += '<option value="' + valueStr + '">' + screenNames[i].innerText + '</option>'
        }
    }

    var dialog = document.getElementById('dialog');
    dialog.style.display = "block";
    return;
}