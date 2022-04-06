//URL Variable
var fetchURL = window.location.pathname;

//Validation alert
function showValidation(error, status) {
    if (error == 0) {
        $('.modal').modal('hide');
        $('.alert').addClass("show");
        $('.alert').removeClass("hide");
        $('.alert').addClass("showAlert");
        getData(fetchURL);
    }
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

//function for All submit Button
function buttonFunction() {
    //Add submit Function
    $('.addFormModal').on('submit', function (e) {

        var formData = $(this);
        var actionUrl = $(this).attr('action');
        var type = $(this).attr('method');

        try {
            ajaxFunction(formData, actionUrl, type, e).then((data) => {
                //console.log(data.status)

                if (data.status == 1) {
                    showValidation(0, "Successfully Added");
                } else {
                    //
                    console.log(data.error);
                    /* var firstItem = data.error;

                    for(key in firstItem) {
                        console.log('error' + ':' + firstItem[key]);
                      } */
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
            ajaxFunction(formData, actionUrl, type, e)

                .then((data) => {
                    //console.log(data.status)

                    if (data.status == 1) {
                        showValidation(0, "Successfully Updated");
                    } else {
//
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
                //console.log(data.status)

                if (data.status == 1) {
                    showValidation(0, "Successfully Deleted");
                } else {
                    //
                }
            });
        } catch (error) {
            console.log('Error:', error);
        }

    });
}

//Populate
function getData(fetchURL) {
    let itemData = [];
    let itemKeys = [];
    let button =
        "<button class='btn bg-info edit ml-2' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>\
         <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";

    $.ajax({
        type: "GET",
        url: fetchURL,
        dataType: "json",
        success: function (response) {
            let dataName = Object.keys(response)[0];
            $("#table-content").DataTable().clear();

            $.each(response[dataName], function (key, item) {
                itemData = item;
            });
            for (var i in itemData) {
                itemKeys.push(i);
            }
            $.each(response[dataName], function (key, item) {

                let itemArray = [];
                for (let i = 0; i < itemKeys.length; i++) {
                    itemArray.push(item[itemKeys[i]]);
                }
                itemArray.push(button);

                $('#table-content').dataTable().fnAddData(itemArray);

            });
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
        beforeSend: function () {
            $('.msg').text('');
        },
        success: function (data) {},
    }));
}

//Button for Edit and Delete
function actionButton() {
    var editURL = $('#editForm').attr('action');
    var delURL = $('#delForm').attr('action');
    table.on('click', '.edit', function () {
        $('.msg').text('');
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();
        
        $('#editLocName').val(data[1]);
        $('#editForm').attr('action',editURL + '/' + data[0]);
    })
    table.on('click', '.del', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();
        var postURL = $('#delForm').attr('action');

        $('#delLocName').html('Confirm Deletion of : ' + data[1]);
        $('#delForm').attr('action',delURL + '/' + data[0]);
    })
    $('.add').click(function () {
        $('.msg').text('');
    });
}
