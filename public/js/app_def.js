
// 取得する場合
var getUrl = location.href;

getUrl = getUrl.substr(-4);
getUrl = getUrl.substr(getUrl.indexOf('/'));

document.getElementById('nav-tran').href += getUrl;
document.getElementById('nav-screen').href += getUrl;
document.getElementById('nav-desi').href += getUrl;
//Conect(str.substr(11,parseInt(str.indexOf('f_'))-12),str.substr(str.indexOf('f_')+2, (str.substr(str.indexOf('f_')+2)).indexOf(" ") ),conecters[i].id)
