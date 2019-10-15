$(document).ready(function() {
    var todoListItem = $('.todo-list');

    $('.todo-list-add-btn').on("click", function(event) {
        event.preventDefault();

        var item = $(this).prevAll('.todo-list-input').val();

        if (item) {
            todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove mdi mdi-close-circle-outline'></i></li>");
            todoListInput.val("");
        }
    });

    todoListItem.on('change', '.checkbox', function() {
        if ($(this).attr('checked')) {
            $(this).removeAttr('checked');
        } else {
            $(this).attr('checked', 'checked');
        }

        $(this).closest("li").toggleClass('completed');
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

                    if(response.message.length > 0) {
                        pageDangerMessage.text(response.message).show();
                    }
                    else {
                        pageDangerMessage.text('').hide();
                    }
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
