$(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll <= 1000) {
            $(".top").css("display", "none");
        } else {
            $(".top").css("display", "");
        }
    });
});


