/**
 * ゲスト（ログイン、登録画面）用js
 * 背景のアニメーション
 */

/* ↓↓↓↓ 泡をふわふわ表示させるアニメーション ↓↓↓↓ */

// キャンバスを設定
var Canvas = document.getElementById('canvas');
var ctx = Canvas.getContext('2d');

var resize = function() {
    Canvas.width = Canvas.clientWidth;
    Canvas.height = Canvas.clientHeight;
};
window.addEventListener('resize', resize);
resize();

var elements = [];  // 表示する泡を格納する
var presets = {};   // 泡生成用

/**
 * 泡を作るメソッド
 * 引数をもとに大きさ、位置をランダムに生成
 */
presets.o = function (x, y, s, dx, dy) {
    return {
        x: x,
        y: y,
        r: 60 * s, // 最大の大きさ
        w: 5 * s,
        dx: dx,
        dy: dy,
        draw: function(ctx, t) {
            this.x += this.dx;
            this.y += this.dy;
            
            ctx.beginPath();
            ctx.arc(this.x + + Math.sin((50 + x + (t / 10)) / 100) * 3, this.y + + Math.sin((45 + x + (t / 10)) / 100) * 4, this.r, 0, 2 * Math.PI, false);
            ctx.lineWidth = this.w;
            ctx.strokeStyle = '#0bd';
            ctx.stroke();
        }
    }
};

/**
 *　キャンバスの縦横の大きさだけループさせ泡を作成する
*/
for(var x = 0; x < Canvas.width; x++) {
    for(var y = 0; y < Canvas.height; y++) {
        if(Math.round(Math.random() * 8000) == 1) {
            var s = ((Math.random() * 5) + 1) / 10;
            if(Math.round((Math.random() * (4 - 1)) + 1) == 1)
                elements.push(presets.o(x, y, s, 0, 0));  // 画面一面泡にならないよう、ランダム変数を用いて作成する泡を厳選
        }
    }
}

/**
 * 実際に泡をふわふわ表示させていく
 */
setInterval(function() {
    ctx.clearRect(0, 0, Canvas.width, Canvas.height);

    var time = new Date().getTime();
    for (var e in elements)
        elements[e].draw(ctx, time);
}, 10);

/* ↑↑↑↑ 泡をふわふわ表示させるアニメーション ↑↑↑↑ */

/* ↓↓↓↓ 波を表示させるアニメーション ↓↓↓↓ */
// 少し激しい？波
$('#wave').wavify({
    height: 300,    // 波の水平線の高さ(数値が少なければ高いところに表示される)
    bones: 2,       // 波の種類？(数値が低いと若干高低差がなくなる)
    amplitude: 40,  // 波の高さ(数値が大きいと高低差が激しくなる)
    color: '#0bd',  // 波の色
    speed: .25      // 波の動くスピード(数値が少ないと早くなる。)
});
// 少しおだやかな波
$('#wave2').wavify({
    height: 400,
    bones: 3,
    amplitude: 50,
    color: '#0bd',
    speed: .70
});

/* ↑↑↑↑ 波を表示させるアニメーション ↑↑↑↑ */