$(function(){

    // Put csrf-token form Laravel in headers
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // When some state button is cliecked
    $(".change_status").click(function(){

        // Get some information of the repective task
        var task_id = $(this).data('task-id');
        var actual_state = $(this).data('actual-state');
        var state_change = $(this).data('state-change');
        var text_btn = $(this).text();

        // Get HTML elements that going to be changed
        var btn_status = $('.btn_status[data-task-id="' + task_id + '"]');
        var table_line_status = $('.table_line_status[data-task-id="' + task_id + '"]');
        var updated_at_field = $('.updated_at_field[data-task-id="' + task_id + '"]');

        // Make an AJAX request only if there is a new state to change
        if(actual_state != state_change){

            $.ajax({
                url: '/task/change_state',
                type: 'POST',
                data: {
                    task_id: task_id,
                    state_change: state_change
                },
                dataType: 'json',
                success: function (data) {
                    // if successfully changed
                    if(data.status){
                        // call a function to change colors and status of the table and button and change the updated date
                        change_status_color(state_change, text_btn, btn_status, table_line_status, updated_at_field, data.updt);

                        // display a message
                        $('.message_modal_content').html('<p class="text-success"> <i class="fa fa-check"></i> Status successfully updated.</p>');
                        $('.modal_message').modal('show');

                        // update the actual state of the button
                        $('.change_status[data-task-id="' + task_id + '"]').data('actual-state', state_change);
                    }else{
                        // display a error message
                        $('.message_modal_content').html('<p class="text-danger"> <i class="fa fa-close"></i> Impossible to update.</p>');
                        $('.modal_message').modal('show');
                    }
                },
                error: function(){
                    // display a error message
                    $('.message_modal_content').html('<p class="text-danger"> <i class="fa fa-close"></i> Impossible to update.</p>');
                    $('.modal_message').modal('show');
                }
            });
        }

    });

    //Function to chage the colors of the Line status in the table and in the button
    function change_status_color(status_change, text_btn, btn_status, table_line_status, updated_at_field, new_updt_date){
        btn_status.html(text_btn + ' <span class="caret"></span>');
        updated_at_field.text(new_updt_date);

        if(status_change == 'new'){
            btn_status.removeClass("btn-warning btn-success");
            btn_status.addClass("btn-primary");
            table_line_status.removeClass("warning success");
            table_line_status.addClass("info");
        }
        else if (status_change == 'in-progress'){
            btn_status.removeClass("btn-primary btn-success");
            btn_status.addClass("btn-warning");
            table_line_status.removeClass("info success");
            table_line_status.addClass("warning");
        }else{
            btn_status.removeClass("btn-warning btn-primary");
            btn_status.addClass("btn-success");
            table_line_status.removeClass("warning info");
            table_line_status.addClass("success");
        }
    }
});
