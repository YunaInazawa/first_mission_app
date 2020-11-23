let alreadyTmpObj = '<div class="obj"';

StartFunc();
function StartFunc(){
    // '.canvas'を持つ要素を取得
    const tabTargets = document.querySelectorAll('.screen');
    let key = Object.keys(object);
    for (var k in key) {
        var objitemset = '';// class="obj_btn" value="blue">RED</button>
        var styleSet = 'style="top: ' + object[key[k]]['y'] + 'px; left: ' + object[key[k]]['x'] + 'px; font-size: ' + object[key[k]]['fontsize'] +'px; height: ' + object[key[k]]['height'] + 'px; width: ' + object[key[k]]['width'] + 'px;"';
        if(object[key[k]]['element'] == "Buttom"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += '<button onclick="ClickButton(event)" class="obj" ' + styleSet +' id="obj_already_btn_' + key[k] + '" value="' + object[key[k]]['jumpid'] + '">' + object[key[k]]['name'] + '</button>';
        }/*else if(object[key[k]]['element'] == "CheckBox"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_checkbox"' + styleSet +' id="obj_already_checkbox_' + key[k] + '"><input id="already_checkbox_' + key[k] + '" type="checkbox">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_checkbox_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_checkbox_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "Label"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_label"' + styleSet +' id="obj_already_label_' + key[k] + '">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_label_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_label_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "RadioButtom"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_radio"' + styleSet +' id="obj_already_radio_' + key[k] + '"><input id="already_radio_' + key[k] + '" type="radio">' + object[key[k]]['name'] + '</div>';
            objitemset = objListItem + 'alr_radio_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_radio_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
        }else if(object[key[k]]['element'] == "TextBox"){
            tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_textbox"' + styleSet +' id="obj_already_textbox_' + key[k] + '"><input id="already_textbox_' + key[k] + '" type="text"></div>';
            objitemset = objListItem + 'alr_textbox_' + key[k] + '">' + object[key[k]]['element'] + key[k];
        }*/
        //document.getElementById('links'+object[key[k]]['s']).innerHTML += objitemset + '</a></li>';
    }
}

function ClickButton(event){
    const tabTargets = document.querySelectorAll('.screen');

    // 要素の位置座標を取得
    var clientRect = tabTargets[event.target.value].getBoundingClientRect();
    var clientRect2 = document.getElementById('screenlist').getBoundingClientRect();
    
    var moveX = clientRect.left - 200;
    var moveY = clientRect.top - 85;
    moveX = clientRect2.left - moveX;
    moveY = clientRect2.top - moveY;
    $(document.getElementById('screenlist')).animate({ left:moveX,top:moveY },"slow");
    //$(tabTargets[0]).animate({ left:pos },"slow");

}