$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * 后台文章管理——文章审核
 */
$(".post-audit").click(function (event) {
    var target = $(event.target);
    var post_id = target.attr('post-id');
    var status = target.attr('post-action-status');
    $.ajax({
        url: '/backend/posts/status/' + post_id,
        method: 'POST',
        data: {
            'status': status
        },
        dataType: 'json',
        success: function (data) {
            if (data.error !== 0) {
                alert(data.msg);
                return;
            }
            target.parent().parent().remove();
        }
    });
});

/**
 * 后台专题管理——删除专题
 */
$(".resource-delete").click(function (event) {
    if (confirm("确定删除这个专题？") === false) {
        return;
    }
    var target = $(event.target);
    event.preventDefault();
    var url = $(target).attr("delete-url");

    $.ajax({
        url: url,
        method: "POST",
        data: {
            "_method": 'DELETE'
        },
        dataType: 'json',
        success: function (data) {
            if (data.error !== 0) {
                alert(data.msg);
                return;
            }
            window.location.reload();
        }
    });
});
