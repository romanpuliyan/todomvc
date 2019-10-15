$(document).ready(function() {
    var todoListItem = $('.todo-list');

    // CHANGE TASK STATUS
    todoListItem.on('change', '.checkbox', function() {

        var checkbox = $(this);
        checkbox.attr("disabled", "disabled");

        var completed = false;
        if (checkbox.attr('checked')) {
            checkbox.removeAttr('checked');
        } else {
            completed = true;
            checkbox.attr('checked', 'checked');
        }

        var checkboxId = checkbox.attr("id");
        var splited    = checkboxId.split('_');
        var taskId     = splited[1];

        $.ajax({
            type: 'POST',
            url: '/task/change-status',
            data: "taskId=" + taskId,
            dataType: 'json',
            success: function(response) {

            }
        });

        checkbox.closest("li").toggleClass('completed');
    });

    todoListItem.on('click', '.remove', function() {
        $(this).parent().remove();
    });

    $(function () {
        $('.filter-date').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });

    // CREATE TASK
    $(".todo-submit").on("click", function(e) {
        e.preventDefault();

        var data = $("#taskForm").serialize();

        $.ajax({
            type: 'POST',
            url: '/task/create',
            data: data,
            dataType: 'json',
            success: function(response) {

                if(response.error != undefined) {

                    var titleField         = $("#itemTitle");
                    var descriptionField   = $("#itemDescription");
                    var modalDangerMessage = $("#modalDangerMessage");

                    if(response.errors.title != undefined) {
                        titleField.addClass("is-invalid").removeClass("is-valid");
                        titleField.siblings(".invalid-feedback").text(response.errors.title).show();
                    }
                    else {
                        titleField.removeClass("is-invalid").addClass("is-valid");
                        titleField.siblings(".invalid-feedback").text('').hide();
                    }

                    if(response.errors.description != undefined) {
                        descriptionField.addClass("is-invalid").removeClass("is-valid");
                        descriptionField.siblings(".invalid-feedback").text(response.errors.description).show();
                    }
                    else {
                        descriptionField.removeClass("is-invalid").addClass("is-valid");
                        descriptionField.siblings(".invalid-feedback").text("").hide();
                    }

                    if(response.errors.common != undefined) {
                        modalDangerMessage.text(response.errors.common).show();
                    }
                    else {
                        modalDangerMessage.text('').hide();
                    }
                }
                else if(response.success != undefined) {
                    window.location.href = '/';
                }

            }
        });
    });

    // DELETE TASK
    $(".delete-button").on("click", function(e) {
        e.preventDefault();
        var buttonId = $(this).attr("id");
        var splited  = buttonId.split('_');
        var taskId   = splited[1];

        $.ajax({
            type: 'POST',
            url: '/task/delete',
            data: "taskId=" + taskId,
            dataType: 'json',
            success: function(response) {
                if(response.error != undefined) {
                    var pageDangerMessage = $("#pageDangerMessage");

                    if(response.message != undefined) {
                        pageDangerMessage.text(response.message).show();
                    }
                    else {
                        if(response.errors != undefined && response.errors.common != undefined) {
                            pageDangerMessage.text(response.errors.common).show();
                        }
                        else {
                            pageDangerMessage.text('').hide();
                        }
                    }
                }
                else if(response.success != undefined) {
                    window.location.href = '/';
                }
            }
        });
    });

    // LOGOUT
    $(".logout-button").on("click", function(e) {
        e.preventDefault();
        window.location.href = "/user/logout";
    });
});
