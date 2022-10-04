<!DOCTYPE html>
<html>

<head>
    <title>Ajax-Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
        .card {
            margin: 1%;
            float: none;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        p {
            display: inline;
        }

        #tbl {
            margin-top: 1%;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">AjaxCrud</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="card">
        <h5 class="card-header">Employee List</h5>
        <div class="card-body">

            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add Record</button>
            <div id="myAlert" role="alert" class="alert alert-dismissible fade" style="display:none;">
                <strong>Note!</strong>
                <p>Example of AJAX CRUD.</p>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <table class="table table-bordered table-sm" id="tbl">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Employee Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Department</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="tbl_body">

                </tbody>
            </table>
        </div>

    </div>
    <!-- Insert Modal -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="insert_data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Employee Id</b></label>
                            <input type="text" name="emp_id" class="form-control" placeholder="Employee Id">
                        </div>
                        <div class="form-group">
                            <label><b>Name</b></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label><b>Department</b></label>
                            <select class="custom-select" name="department" id="department">
                                <option value="" selected>Choose...</option>
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="R&D">R&D</option>
                                <option value="Sales">Sales</option>
                                <option value="Quality">Quality</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Financial">Financial</option>
                                <option value="Operations">Operations</option>
                                <option value="Administration">Administration</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Designation</b></label>
                            <input type="text" name="designation" class="form-control" placeholder="Enter Designation">
                        </div>
                        <div class="form-group">
                            <label><b>Joining Date</b></label>
                            <input type="date" name="joining_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="mr-3"><b>Gender :- </b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="0">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="success-msg" id="success_msg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Insert Modal -->
    <!-- Update Modal -->
    <div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="updateModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalCenterTitle">Update Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="update_data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <div class="form-group">
                            <label><b>Employee Id</b></label>
                            <input type="text" name="emp_id" id="emp_id" class="form-control" placeholder="Employee Id">
                        </div>
                        <div class="form-group">
                            <label><b>Name</b></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label><b>Department</b></label>
                            <select class="custom-select" name="department" id="department">
                                <option value="" selected>Choose...</option>
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="R&D">R&D</option>
                                <option value="Sales">Sales</option>
                                <option value="Quality">Quality</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Financial">Financial</option>
                                <option value="Operations">Operations</option>
                                <option value="Administration">Administration</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Designation</b></label>
                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation">
                        </div>
                        <div class="form-group">
                            <label><b>Joining Date</b></label>
                            <input type="date" name="joining_date" id="joining_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="mr-3"><b>Gender :- </b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="0">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="success-msg" id="success_msg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Update Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalCenterTitle">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="deleterec">Delete Record</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            loadTable();

            $('#insert_data').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'ins_emp_data',
                    cache: false,
                    dataType: 'json',
                    data: $(this).serialize(),
                }).done(function(dataResult) {
                    (dataResult.status == 1) ?
                    showAlert('Success!', dataResult.message, 'success'):
                        showAlert('Something went wrong!', dataResult.message, 'danger');
                }).fail(function(dataResult) {
                    showAlert('Something went wrong!', 'Please try again later.', 'danger');
                }).always(function(dataResult) {
                    loadTable();
                    $('#insert_data').trigger('reset');
                    $('#close_click').trigger('click');
                });
            })

            $(document).on('click', "button.editdata", function() {
                var check_id = $(this).data('id');
                $.getJSON("get_edit_data", {
                    checkid: check_id
                }, function(json) {
                    $('#updateModalCenter').modal('show');
                    var jsonData = json.data[0];
                    if (json.status == 1) {
                        $('#id').val(jsonData.id);
                        $('#emp_id').val(jsonData.emp_id);
                        $('#name').val(jsonData.name);
                        $('#email').val(jsonData.email);
                        $("#department option[value='" + jsonData.department + "']").prop("selected", "selected");
                        $('#designation').val(jsonData.designation);
                        $('#joining_date').val(jsonData.joining_date);
                        if (jsonData.gender == 1) {
                            $('#male').prop('checked', true);
                        } else {
                            $('#female').prop('checked', true);
                        }
                    }
                }).fail(function() {
                    loadTable();
                    showAlert('Something went wrong!', 'Please try again.', 'danger');
                })
            })

            $('#update_data').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'upd_emp_data',
                    cache: false,
                    dataType: 'json',
                    data: $(this).serialize(),
                }).done(function(dataResult) {
                    (dataResult == true) ?
                    showAlert('Success!', 'Data updated successfully!', 'success'):
                        showAlert('Something went wrong!', 'Please try again later.', 'danger');
                }).fail(function(dataResult) {
                    showAlert('Something went wrong!', 'Please try again later.', 'danger');
                }).always(function(dataResult) {
                    loadTable();
                    $('#updateModalCenter').modal('hide');
                });
            })

            $(document).on('click', 'button.deletedata', function() {
                $('#deleteModalCenter').modal('show');
                deleteid = $(this).data('id');
            })

            $('#deleterec').click(function(){
                
                $.ajax({
                    type: 'POST',
                    url: 'delete_emp_data',
                    cache: false,
                    dataType: 'json',
                    data: {deleteid: deleteid},
                }).done( function (dataResult) {
                    (dataResult == true) ? 
                    showAlert('Success! ', 'Data deleted successfully!', 'success') :
                    showAlert('Something went wrong! ', 'Please try again later.', 'danger');
                }).fail( function (dataResult){
                     showAlert('Something went wrong! ', 'Please try again later.', 'danger');
                }).always( function() {
                    loadTable();
                    $("#deleteModalCenter").modal('hide');
                });
            })
        })

        function showAlert(msg_title, msg_body, msg_type) {
            var alert = $('div[role="alert"]');
            $(alert).find('strong').html(msg_title);
            $(alert).find('p').html(msg_body);
            $(alert).removeAttr('class');
            $(alert).addClass('alert alert-' + msg_type);
            $(alert).show();
        }

        function loadTable() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost/ajax-crud/get_emp_data',
                data: {},
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    $('#tbl_body').empty();
                    var result = dataResult.data;
                    var bodyData = '';
                    var i = 1;
                    if (result != null) {
                        $.each(result, function(index, row) {
                            var bodyData = `<tr>
                                    <td>${ i++ }</td>
                                    <td>${ row.emp_id }</td>
                                    <td>${ row.name }</td>
                                    <td>${ row.email }</td>
                                    <td>${ row.department }</td>
                                    <td>${ row.designation }</td>
                                    <td>${ row.joining_date }</td>
                                    <td>${ (row.gender == 1) ? 'Male' : 'Female'}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info editdata" data-id="${ row.id }">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger deletedata" data-id="${ row.id }">Delete</button>
                                    </td>
                                    <tr>`;
                            $('#tbl').append(bodyData);
                        })
                    } else {
                        bodyData = `<tr><td colspan="8" class="text-center">No Data Found!</td></tr>`;
                        $('#tbl').append(bodyData);
                    }
                }
            })
        }
    </script>
</body>

</html>