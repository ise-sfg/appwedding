// トースト通知クラス
var Toast = (function(){
    var timer;
    var speed;
    function Toast() {
        this.speed = 2000;
    }
    // メッセージを表示。表示時間(speed)はデフォルトで3秒
    Toast.prototype.show = function(message, speed) {
        if (speed === undefined) speed = this.speed;
        $('.toast').remove();
        clearTimeout(this.timer);
        $('body').append('<div class="toast">' + message + '</div>');
        var leftpos = $('body').width()/2 - $('.toast').outerWidth()/2;
        $('.toast').css('left', leftpos).hide().fadeIn('fast');

        this.timer = setTimeout(function() {
            $('.toast').fadeOut('slow',function(){
                $(this).remove();
            });
        }, speed);
    };
    // 明示的にメッセージを消したい場合は使う
    Toast.prototype.hide = function() {
        $('.toast').fadeOut('slow',function() {
            $(this).remove();
        });
    }
    return Toast;
})();
