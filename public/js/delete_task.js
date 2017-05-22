$(function(){
    $('a[name="remove_levels"]').on('click', function(e) {
        var url = $(this).data('url');
        var task_name = $(this).data('task-name');
        var task_number = $(this).data('task-number');
        var msg = "<p>Are you sure you want to delete the task number: " + task_number + "? </p>";
        msg += "<p><b>" + task_name + "</b></p>"
        $('.modal_delete_msg').html(msg);

        e.preventDefault();
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .one('click', '#delete', function(e) {
            window.location.href = url;
        });
    });

});
