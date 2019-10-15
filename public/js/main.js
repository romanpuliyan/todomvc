$(document).ready(function() {
    var todoListItem = $('.todo-list');

    // CHANGE TASK STATUS
    todoListItem.on('change', '.checkbox', function() {

        var checkbox = $(this);
        checkbox.attr("disabled", "disabled");

        var completed = 0;
        if (checkbox.attr('checked')) {
            checkbox.removeAttr('checked');
        } else {
            completed = 1;
            checkbox.attr('checked', 'checked');
        }

        var checkboxId = checkbox.attr("id");
        var splited    = checkboxId.split('_');
        var taskId     = splited[1];

        $.ajax({
            type: 'POST',
            url: '/task/change-status',
            data: "taskId=" + taskId + "&completed=" + completed,
            dataType: 'json',
            success: function(response) {
                if(response.error != undefined) {
                    mainPageDangerMessage(response);
                }
                else if(response.success != undefined) {
                    checkbox.removeAttr("disabled");
                }
            }
        });

        checkbox.closest("li").toggleClass('completed');
    });

    todoListItem.on('click', '.remove', function() {
        $(this).parent().remove();
    });

    // INIT DATEPICKER
    $(function () {
        $('.filter-date-from').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('.filter-date-to').datetimepicker({
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
                    mainPageDangerMessage(response);
                }
                else if(response.success != undefined) {
                    window.location.href = '/';
                }
            }
        });
    });

    // FILTER TASK
    $(".todo-list-filter-btn").on("click", function(e) {
        e.preventDefault();

        var title       = $(".filter-title").val();
        var description = $(".filter-description").val();
        var dateFrom    = $(".filter-date-from-input").val();
        var dateTo      = $(".filter-date-to-input").val();

        $.ajax({
            type: 'POST',
            url: '/task/filter',
            data: "title=" + title + "&description=" + description + "&dateFrom=" + dateFrom + "&dateTo=" + dateTo,
            dataType: 'html',
            success: function(response) {
                if(response.length > 0) {
                    $(".list-wrapper").html(response);
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

function mainPageDangerMessage(response) {
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
