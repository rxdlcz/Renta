//URL Variable
var fetchURL = window.location.pathname;

//Populate
function getData(fetchURL) {
    let itemData = [];
    let itemKeys = [];
    let button;

    if (fetchURL == "/tenant") {
        button =
            "<button class='btn bg-info detail ml-2' data-bs-toggle='modal' data-bs-target='#tenantDetailModal'>View Tenant</button>\
            <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";
    } else if (fetchURL == "/payment") {
        button = "<button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";
    } else {
        button =
            "<button class='btn bg-info edit ml-2' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>\
            <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";
    }

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
                statusUpdate();
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
            $('.txt_error').text('');
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

    var bTable = $('#bills-content').dataTable();

    //Edit action
    table.on('click', '.edit', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();

        $('#editForm').attr('action', editURL + '/' + data[0]); //add id to form action attribute

        $('.txt_error').text('') //clear span error text

        $("#modalInput option:selected").each(function () {
            $(this).removeAttr('selected');
        });

        $('#modalInput input, #modalInput select').each(
            function (index) {
                var input = $(this);
                input.val(data[index + 1]);
                if ($(input).is("select")) {
                    $('option').filter(function () {
                        return $(this).text() === data[index + 1];
                    }).attr('selected', true)
                }
            }
        );
    })

    //Delete action
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

    //Adjust datatable header on tab
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    //Show Details action
    table.on('click', '.detail', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }
        var data = table.row($tr).data();

        var fetchURL = '/getTenantDetails/' + data[0];

        $('#detailForm').attr('action', '/editTenant/' + data[0]);

        $.ajax({
            type: "GET",
            url: fetchURL,
            dataType: "json",
            beforeSend: function () {
                bTable.dataTable().fnClearTable();
                bTable.dataTable().fnDraw();
                bTable.dataTable().fnDestroy();
            },
            success: function (response) {
                //console.log(response.bills);
                var tenant = response.tenants;
                var bill = response.bills;

                //add value to select
                $('.detailForm select[name=unit_id]').empty();
                $.each(response.units, function (key, value) {
                    $('.detailForm select[name=unit_id]').append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
                });

                //add value to View and update Tab
                for (key in tenant) {
                    $('.detailForm input[name=' + key + ']').val(tenant[key]);
                    $('.detailForm select[name=' + key + ']').val(tenant[key]);
                }

                bTable.DataTable({
                    "scrollY": "250px",
                    "scrollCollapse": true,
                    "paging": false,
                    "scrollX": true,
                    "scroller": true,
                });

                //add value to bills tab
                $.each(bill, function (key, item) {
                    bTable.dataTable().fnAddData([
                        item.id,
                        item.bill_type,
                        item.amount_balance,
                        item.due_date,
                        item.status
                    ]);
                });
            }
        });
    })
}

function statusUpdate() {
    var column = document.getElementById("table-content").rows;

    for (let i = 1; i < column.length; i++) {
        var colSize = document.getElementById("table-content").rows[i].cells.length;
        var colStatus = column[i].cells[colSize - 2];

        switch (colStatus.innerHTML) {
            case "0":
                colStatus.innerHTML = "Vacant";
                break;
            case "1":
                colStatus.innerHTML = "Occupied";
                break;
            case "2":
                colStatus.innerHTML = "Unpaid";
                break;
            case "3":
                colStatus.innerHTML = "Paid";
                break;
            case "4":
                colStatus.innerHTML = "Pending Balance";
                break;
            case "5":
                colStatus.innerHTML = "Unpaid Bills";
                break;
            case "6":
                colStatus.innerHTML = "Occupied";
                break;
            case "7":
                colStatus.innerHTML = "Occupied";
                break;
        }
    }
}
