let alreadyTmpObj = '<div class="obj"';

StartFunc();
// function StartFunc(){
//     // '.canvas'を持つ要素を取得
//     const tabTargets = document.querySelectorAll('.screen');
//     let key = Object.keys(object);
//     var arrayJump = [];
//     var arrayform = [];
//     var cnt = 0;
//     for (var k in key) {
//         var objitemset = '';// class="obj_btn" value="blue">RED</button>
//         var styleSet = 'style="top: ' + object[key[k]]['y'] + 'px; left: ' + object[key[k]]['x'] + 'px; font-size: ' + object[key[k]]['fontsize'] +'px; height: ' + object[key[k]]['height'] + 'px; width: ' + object[key[k]]['width'] + 'px;"';
//         if(object[key[k]]['element'] == "Buttom"){
//             tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += '<button onclick="ClickButton(event)" class="obj" ' + styleSet +' id="obj_already_btn_' + key[k] + '" value="' + object[key[k]]['jumpid'] + '">' + object[key[k]]['name'] + '</button>';
//             if(object[key[k]]['jumpid'] != "" || object[key[k]]['jumpid'] != null){
//                 arrayJump[cnt] = object[key[k]]['jumpid'];
//                 arrayform[cnt] = object[key[k]]['screen'];
//                 cnt++;
//             //    Conect('t_' + object[key[k]]['screen'] + '_to_t_' + object[key[k]]['jumpid'],object[key[k]]['jumpid'],object[key[k]]['screen']);
//             }
//         }/*else if(object[key[k]]['element'] == "CheckBox"){
//             tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_checkbox"' + styleSet +' id="obj_already_checkbox_' + key[k] + '"><input id="already_checkbox_' + key[k] + '" type="checkbox">' + object[key[k]]['name'] + '</div>';
//             objitemset = objListItem + 'alr_checkbox_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_checkbox_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
//         }else if(object[key[k]]['element'] == "Label"){
//             tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_label"' + styleSet +' id="obj_already_label_' + key[k] + '">' + object[key[k]]['name'] + '</div>';
//             objitemset = objListItem + 'alr_label_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_label_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
//         }else if(object[key[k]]['element'] == "RadioButtom"){
//             tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_radio"' + styleSet +' id="obj_already_radio_' + key[k] + '"><input id="already_radio_' + key[k] + '" type="radio">' + object[key[k]]['name'] + '</div>';
//             objitemset = objListItem + 'alr_radio_' + key[k] + '">' + object[key[k]]['element'] + key[k] + '-<span id="list_alr_radio_' + key[k] + '">' + object[key[k]]['name'] + '</span>';
//         }else if(object[key[k]]['element'] == "TextBox"){
//             tabTargets[parseInt(object[key[k]]['screen'])].innerHTML += alreadyTmpObj + 'obj_textbox"' + styleSet +' id="obj_already_textbox_' + key[k] + '"><input id="already_textbox_' + key[k] + '" type="text"></div>';
//             objitemset = objListItem + 'alr_textbox_' + key[k] + '">' + object[key[k]]['element'] + key[k];
//         }*/
//         //document.getElementById('links'+object[key[k]]['s']).innerHTML += objitemset + '</a></li>';
//     }
//     for (var i in arrayJump){
//         document.getElementById('screenlist').innerHTML += '<canvas class="conecter" id="t_' + arrayform[i] + '_to_t_' + arrayJump[i] + '"></canvas>';
//     }
//     Conect(arrayJump,arrayform);
// //    document.getElementById('screenlist').innerHTML += '<canvas class="conecter" id="t_' + object[key[k]]['screen'] + '_to_t_' + object[key[k]]['jumpid'] + '"></canvas>';

 
// }

// 2020/11/25(水) sei [4-44: ｺﾒﾝﾄｱｳﾄ, 47-91: 追加]
function StartFunc(){
    var arrayJump = [];
    var arrayform = [];

    // 画面ループ (s_id = scene_id)
    for (var s_id in object) {
        // 要素ループ (e_id = element_id)
        for(var e_id in object[s_id]){
            var element = object[s_id][e_id];       // 略
            styleSet =                          // button / style 設定
            'style="top: ' + element['position_y'] + 'px; ' + 
            'left: ' + element['position_x'] + 'px; ' + 
            'font-size: ' + element['font_size'] +'px; ' + 
            'height: ' + element['height'] + 'px; ' + 
            'width: ' + element['width'] + 'px;"';
            /* 要素が「Button」のとき */
            if( element['element_id'] == elementsId['Button'] ){    
                styleSet =                          // button / style 設定
                'style="top: ' + element['position_y'] + 'px; ' + 
                'left: ' + element['position_x'] + 'px; ' + 
                'font-size: ' + element['font_size'] +'px; ' + 
                'height: ' + element['height'] + 'px; ' + 
                'width: ' + element['width'] + 'px;"';
                /* 遷移先が設定されているとき */
                if(element['move_scene_id'] != null){

                    // button 作成
                    document.getElementById('t_' + element['scene_id']).innerHTML += 
                    '<button onclick="ClickButton(event)" class="obj obj_btn" ' + styleSet +' id="obj_already_btn_' + element['id'] + '" value="' + element['move_scene_id'] + '">' + element['text'] + '</button>';

                    // canvas 作成
                    document.getElementById('screenlist').innerHTML += 
                    '<canvas class="conecter" id="t_' + element['scene_id'] + '_to_t_' + element['move_scene_id'] + '"></canvas>';

                    // arrayJump, arrayForm 追加
                    arrayJump.push(element['move_scene_id']);
                    arrayform.push(element['scene_id']);
                
                }else{

                    // button 作成
                    document.getElementById('t_' + element['scene_id']).innerHTML += 
                    '<button class="obj obj_btn" ' + styleSet +' id="obj_already_btn_' + element['id'] + '" value="">' + element['text'] + '</button>';

                }

            /* 要素が「Link」のとき */
            }else if( element['element_id'] == elementsId['Link'] ){
                styleSet =                          // link / style 設定
                'style="top: ' + (element['position_y']-1) + 'px; ' + 
                'left: ' + (element['position_x']-6) + 'px; ' + 
                'font-size: ' + element['font_size'] +'px; ' + 
                'height: ' + element['height'] + 'px; ' + 
                'width: ' + element['width'] + 'px;"';

                /* 遷移先が設定されているとき */
                if(element['move_scene_id'] != null){

                    // button 作成
                    document.getElementById('t_' + element['scene_id']).innerHTML += 
                    '<button onclick="ClickButton(event)" class="obj obj_link" ' + styleSet +' id="obj_already_btn_' + element['id'] + '" value="' + element['move_scene_id'] + '">' + element['text'] + '</button>';
                    // canvas 作成
                    document.getElementById('screenlist').innerHTML += 
                    '<canvas class="conecter" id="t_' + element['scene_id'] + '_to_t_' + element['move_scene_id'] + '"></canvas>';

                    // arrayJump, arrayForm 追加
                    arrayJump.push(element['move_scene_id']);
                    arrayform.push(element['scene_id']);

                }else{

                    // button 作成
                    document.getElementById('t_' + element['scene_id']).innerHTML += 
                    '<button class="obj obj_link" ' + styleSet +' id="obj_already_btn_' + element['id'] + '" value="">' + element['text'] + '</button>';

                }
                
            }else if( element['element_id'] == elementsId['CheckBox'] ){
                document.getElementById('t_' + element['scene_id']).innerHTML += 
                '<div class="obj obj_checkbox" ' + styleSet +' id="obj_already_checkbox_' + element['id'] + '"><input id="already_checkbox_' + element['id'] + '" type="checkbox">' + element['text'] + '</div>';
            }else if(element['element_id'] == elementsId['Label']){
                document.getElementById('t_' + element['scene_id']).innerHTML += 
                '<div class="obj obj_label"' + styleSet +' id="obj_already_label_' + element['id'] + '">' + element['text'] + '</div>';
            }else if(element['element_id'] == elementsId['RadioButton']){
                document.getElementById('t_' + element['scene_id']).innerHTML += 
                '<div class="obj obj_radio"' + styleSet +' id="obj_already_radio_' + element['id'] + '"><input id="already_radio_' + element['id'] + '" type="radio">' + element['text'] + '</div>';
            }else if(element['element_id'] == elementsId['TextBox']){
                document.getElementById('t_' + element['scene_id']).innerHTML += 
                '<div class="obj obj_textbox"' + styleSet +' id="obj_already_textbox_' + element['id'] + '"><input id="already_textbox_' + element['id'] + '" type="text"></div>';
            }

        }
    }
    //Conect(arrayJump,arrayform); 
}

function ClickButton(event){
    // 2020/11/25(水) sei [95: ｺﾒﾝﾄｱｳﾄ]
    // const tabTargets = document.querySelectorAll('.screen');

    // 要素の位置座標を取得
    // 2020/11/25(水) sei [99: ｺﾒﾝﾄｱｳﾄ, 100: 追加]
    // var clientRect = tabTargets[event.target.value].getBoundingClientRect();
    var clientRect = document.getElementById('t_' + event.target.value).getBoundingClientRect();
    var clientRect2 = document.getElementById('screenlist').getBoundingClientRect();
    
    var moveX = clientRect.left - 200;
    var moveY = clientRect.top - 85;
    moveX = clientRect2.left - moveX;
    moveY = clientRect2.top - moveY;
    $(document.getElementById('screenlist')).animate({ left:moveX,top:moveY },"slow");
}

function Conect(jumpIds,formerIds) {
    const tabTargets = document.querySelectorAll('.screen');

    function drawLine(){

        // 2020/11/25(水) sei [116: ｺﾒﾝﾄｱｳﾄ, 117: 追加]
        // for(var i in jumpIds){
        for(var i = 0; i < jumpIds.length; i++){

            var canvas = document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]);
            var ctx = canvas.getContext("2d");
            
            // 2020/11/25(水) sei [123-126: ｺﾒﾝﾄｱｳﾄ, 127-130: 追加]
            // var formCenterX = tabTargets[formerIds[i]].getBoundingClientRect().left + 650;
            // var formCenterY = tabTargets[formerIds[i]].getBoundingClientRect().top + 425;
            // var jumpCenterX = tabTargets[jumpIds[i]].getBoundingClientRect().left + 650;
            // var jumpCenterY = tabTargets[jumpIds[i]].getBoundingClientRect().top + 425;
            var formCenterX = document.getElementById('t_' + formerIds[i]).getBoundingClientRect().left + 650;
            var formCenterY = document.getElementById('t_' + formerIds[i]).getBoundingClientRect().top + 425;
            var jumpCenterX = document.getElementById('t_' + jumpIds[i]).getBoundingClientRect().left + 650;
            var jumpCenterY = document.getElementById('t_' + jumpIds[i]).getBoundingClientRect().top + 425;
            var width = Math.abs(jumpCenterX - formCenterX);
            var height = Math.abs(jumpCenterY - formCenterY);
            var left = 0;
            var top = 0;

            document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).style.width = width + "px";
            document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).style.height = height + "px";
            if(formCenterX <= jumpCenterX && formCenterY <= jumpCenterY){
                left = formCenterX;
                top = formCenterY;
            }else if(formCenterX > jumpCenterX && formCenterY > jumpCenterY){
                left = jumpCenterX;
                top = jumpCenterY;
            }else if(formCenterX < jumpCenterX){
                left = formCenterX;
                top = jumpCenterY;
                document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).classList.add('kaiten');
            }else{
                left = jumpCenterX;
                top = formCenterY;
                document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).classList.add('kaiten');
            }
            
            document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).style.left =left + "px";
            document.getElementById('t_' + formerIds[i] + '_to_t_' + jumpIds[i]).style.top = top + "px";
                
            ctx.strokeStyle = "red";
            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.lineTo(550, 275);
            ctx.closePath();
            ctx.stroke();
        }
    }

    
    onload = drawLine;
};
/**
function Conect(conecterId,jumpIds,formerIds) {
    /*
    width: 1300px;
    height: 850px;*/
  /*  const tabTargets = document.querySelectorAll('.screen');

    var formCenterX = tabTargets[formerId].getBoundingClientRect().left + 650;
    var formCenterY = tabTargets[formerId].getBoundingClientRect().top + 425;
    var jumpCenterX = tabTargets[jumpId].getBoundingClientRect().left + 650;
    var jumpCenterY = tabTargets[jumpId].getBoundingClientRect().top + 425;
    var width = Math.abs(tabTargets[formerId].getBoundingClientRect().left) + Math.abs(tabTargets[jumpId].getBoundingClientRect().left);
    var height = Math.abs(tabTargets[formerId].getBoundingClientRect().top) + Math.abs(tabTargets[jumpId].getBoundingClientRect().top);
    var left = 0;
    var top = 0;

    document.getElementById(conecterId).style.width = width + "px";
    document.getElementById(conecterId).style.height = height + "px";

    if(formCenterX <= jumpCenterX && formCenterY <= jumpCenterY){
        left = formCenterX;
        top = formCenterY;
    }else if(formCenterX > jumpCenterX && formCenterY > jumpCenterY){
        left = jumpCenterX;
        top = jumpCenterY;
    }else if(formCenterX < jumpCenterX){
        left = formCenterX;
        top = jumpCenterY;
    }else{
        left = jumpCenterX;
        top = formCenterY;
    }
    
    document.getElementById(conecterId).style.left =left + "px";
    document.getElementById(conecterId).style.top = top + "px";
    function drawLine(){
        var canvas = document.getElementById(conecterId);
        
        var ctx = canvas.getContext("2d");
        
        ctx.strokeStyle = "red";
        ctx.beginPath();
        ctx.moveTo(left, top);
        ctx.lineTo(550, 275);
        ctx.closePath();
        ctx.stroke();
    }
    
    onload = drawLine;
}; */