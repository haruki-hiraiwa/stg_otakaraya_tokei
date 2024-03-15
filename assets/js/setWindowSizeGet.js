/* 表示デバイスの画面サイズを取得する */
$(function(){

    console.log(window.innerWidth);

    var width = window.innerWidth;

    var setWindowSizeGet = function(){
        $.ajax({
            type: "POST",
            data:{
                'action' : 'set_window_size',
                'windowsize' : width,
            },
            url: ajaxurl, // 起動するサーバプログラムのURL
            success: function( response ) {
                console.log( '成功しました：' + response );
            }
        });
    };

    setWindowSizeGet();      //上記で設定した関数の実行
    // var timer = false;    //タイマーをリセット
    // $(window).resize(function(){
    //     if(timer !== false){clearTimeout(timer);}
    //     timer = setTimeout(setWindowSizeGet,20);
    // });
});
