$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
    }
});
var wEdt = window.wangEditor;
var wangedt = new wEdt('#wangedt');
// 或者 var editor = new E( document.getElementById('wangedt') )
wangedt.create();
$('#passage-store').click(function () {
    var title = $("input[name='title']").val();
    var content = wangedt.txt.html();
    $.ajax({
        url: '/posts/store',
        method: 'POST',
        data: {
            'title': title,
            'content': content
        },
        dataType: 'json',
        success: function (msg) {
            if (msg.errCode !== 0) {
                alert(msg.errMsg);
                return;
            }else{
                alert(msg.errMsg);
            }
        }
    });
});
