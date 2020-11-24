// プロジェクト作成画面 / ユーザ追加
function funcAddUser( users_data ) {
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
     
    dialogHide();
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