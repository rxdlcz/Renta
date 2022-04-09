//URL Variable
var fetchURL = window.location.pathname;

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
            //console.log(response);
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
                    $.each(data.error, function (key, val) {
                        $('span.' + key + '_error').text(val[0]);
                        console.log(key + ':' + val);
                    })
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
                    $('.txt_error').text('')
                    if (data.status == 1) {
                        showValidation(0, "Successfully Updated");
                    } else {
                        $.each(data.error, function (key, val) {
                            $('span.' + key + '_error').text(val[0]);
                            console.log(key + ':' + val);
                        })
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
                    console.log(data);
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
        beforeSend: function () {
            $('.msg').text('');
        },
        success: function (data) {},
    }));
}

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
    $('.txt_error').text('')
    setTimeout(function () {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    }, 3000);

    $('.close-btn').click(function () {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    });
}

//Button for Edit and Delete
function actionButton() {
    var editURL = $('#editForm').attr('action'); //Get action attribute of edit form
    var delURL = $('#delForm').attr('action'); //Get action attribute of delete form

    table.on('click', '.edit', function () {
        $('.msg').text('');
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();

        $('#editForm').attr('action', editURL + '/' + data[0]); //add id to form action attribute

        $('.txt_error').text('') //clear span error text

        $("#modalInput option:selected").each(function () {
            console.log('asdf');
            $(this).removeAttr('selected');
        });

        $('#modalInput input, #modalInput select').each(
            function (index) {
                var input = $(this);
                input.val(data[index + 1]);
                if ($(input).is("select")) {
                    $('option').filter(function() {
                        return $(this).text() === data[index + 1];
                    }).attr('selected', true)
                }
            }
        );
    })
    table.on('click', '.del', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();
        var postURL = $('#delForm').attr('action');

        $('#delLocName').html('Confirm Deletion of : ' + data[1]); //add id to form action attribute
        $('#delForm').attr('action', delURL + '/' + data[0]);
    })
    $('.add').click(function () {
        $('.msg').text('');
    });
}

function statusUpdate() {
    var column = document.getElementById("table-content").rows;

    for (let i = 1; i < column.length; i++) {
        var colLen = document.getElementById("table-content").rows[i].cells.length;
        var colStatus = column[i].cells[colLen - 2];

        switch (colStatus.innerHTML) {
            case "0":
                colStatus.innerHTML = "Vacant";
                break;
            case "1":
                colStatus.innerHTML = "Occupied";
                break;
        }
    }
}
