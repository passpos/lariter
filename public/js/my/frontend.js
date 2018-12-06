$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".btn-default").click(function () {
    var query = $("input[name='query']").val();

    $.ajax({
        url: '/posts/search',
        method: 'POST',
        data: {
            'query': query
        },
        dataType: 'html',
        success: function (data) {
            result = document.write(data);
            return result;
        }
    });
});