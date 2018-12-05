$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".btn-default").click(function (event) {
    var target = $(event.target);
    var query = $("input[name='query']").val();

    $.ajax({
        url: '/posts/search',
        method: 'POST',
        data: {
            'query': query
        },
        dataType: 'json',
        success: function (data) {
            window.location.write(data);
        }
    });
});