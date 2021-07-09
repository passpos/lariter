$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
    }
});

/**
 * 前台粉丝关注
 */
$(".like-button").click(function (event) {
    var target = $(event.target);
    var status_focus = target.attr('like-value');
    var user_id = target.attr('like-user');
    if (status_focus === 1) {
        // 取消关注
        $.ajax({
            url: "/user/unfocus/" + user_id,
            method: 'POST',
            dataType: "json",
            success: function (data) {
                if (data.err !== 0) {
                    alert(data.msg);
                    return;
                }
                target.attr("like-value", 0);
                target.text("关注");
            }
        });
    } else {
        // 关注
        $.ajax({
            url: "/user/focus/" + user_id,
            method: 'POST',
            dataType: "json",
            success: function (data) {
                if (data.err !== 0) {
                    alert(data.msg);
                    return;
                }
                target.attr("like-value", 1);
                target.text("取消关注");
            }
        });
    }
});