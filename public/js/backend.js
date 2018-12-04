$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".post_audit").click(function (event) {
    var target = $(event.target);
    var post_id = target.attr('post_id');
    var status = target.attr('post-action-status');

    /**
     * @TODO 修复发送数据的URL，数据内容
     */
    $.ajax({
        url: '/backend/posts/status' + post_id,
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


$(".resource-delete").click(function (event) {
    if (confirm("确定删除这个专题？") === false) {
        return;
    }
    var target = $(event.target);
    event.preventDefault();
    var url = $(target).attr("delete-url");
    var csrf = $('meta[name="csrf_token"]').attr('content');

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
