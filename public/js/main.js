function showValidation(status) {
    $('.modal').modal('hide');
    $('.alert').addClass("show");
    $('.alert').removeClass("hide");
    $('.alert').addClass("showAlert");
    $('.msg').text(status);
    setTimeout(function () {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    }, 3000);

    $('.close-btn').click(function () {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    });
}

function buttonFunction() {
    //Add submit Function
    $('.addFormModal').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this);
        var actionUrl = $(this).attr('action');
        var type = $(this).attr('method');

        try {
            ajaxFunction(formData, actionUrl, type, e).then((data) => {
                console.log(data.status)

                if (data.status == 1) {               
                    showValidation("Successfully Updated");
                    getTenants();
                } else {
                    console.log(data.error.location[0]);
                }
            });
        } catch (error) {
            console.log('Error:', error);
        }
    });
    //Edit submit Function
    $('.editFormModal').on('submit', function (e) {

        var formData = $(this);
        var actionUrl = $(this).attr('action');
        var type = $(this).attr('method');

        try {
            ajaxFunction(formData, actionUrl, type, e).then((data) => {
                console.log(data.status)

                if (data.status == 1) {
                    showValidation("Successfully Updated");
                    getTenants();
                } else {
                    console.log(data.error.location[0]);
                }
            });
        } catch (error) {
            console.log('Error:', error);
        }
    });

    //Delete submit function
    $('.delFormModal').on('submit', function (e) {

        var formData = $(this);
        var actionUrl = $(this).attr('action');
        var type = $(this).attr('method');

        try {
            ajaxFunction(formData, actionUrl, type, e).then((data) => {
                console.log(data.status)

                if (data.status == 1) {
                    showValidation("Successfully Updated");
                    getTenants();
                } else {
                    console.log(data.error.location[0]);
                }
            });
        } catch (error) {
            console.log('Error:', error);
        }

    });
}

//Ajax function
function ajaxFunction(formData, actionUrl, type, event) {
    event.preventDefault();

    return Promise.resolve($.ajax({
        type: type,
        url: actionUrl,
        processData: false,
        data: $(formData).serialize(),
        beforeSend: function () {},
        success: function (data) {}
    }));
}

//Button for Edit and Delete
function actionButton() {
    table.on('click', '.edit', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();

        $('#editLocName').val(data[1]);
        $('#editForm').attr('action', '/editLocation/' + data[0]);
    })
    table.on('click', '.del', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();

        $('#delLocName').html('Confirm Deletion of : ' + data[1]);
        $('#delForm').attr('action', '/deleteLocation/' + data[0]);
    })
}
