$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
});

$(".post_audit").click(function(event) {
    target = $(event.target);
    var post_id = target.attr('post_id');
    var status = target.attr('post-action-status');

    $.ajax({
        url: '/backend/posts/status',
        method: 'POST',
        data: {
            'post_id': post_id,
            'status': status
        },
        datatype: 'json',
        success: function (data) {
            if (data.error !== 0) {
                alert(data.msg);
                return;
            }
            target.parent().parent().remove();
        }
    });
});