function func() {
    // ここに「はい」選択時の処理
     
    dialogHide();
    return;
}
function dialogHide() {
    var dialog = document.getElementById("dialog");
    dialog.style.display = "none";
    return;
}
function dialogShow() {
    // 必要に応じてここに表示前処理(表示メッセージ変更処理など)を入れる
    
    var dialog = document.getElementById("dialog");
    dialog.style.display = "block";
    return;
}