<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="voters.php"><i
                        class="fas fa-users"></i>&nbsp;<span>Voters</span></a>
        </ol>
    </nav>
    <div class="box">
    <button type="button" class=" btn btn-sm btn-success" onclick="window.location.reload();"><i class="fas fa-sync"></i>&nbsp;Reload</button>
    </div>
    <div class="box">
        <div class="box-header">
            <h5>Voters List</h5>
        </div>
            <table class="table table-striped table-bordered table-hover table-sm  table-responsive-sm"
                id="voters_table" width="100%">
                <thead>
                    <th>Sl. No</th>
                    <th hidden>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                    <th>Register Number</th>
                    <th>Email ID</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM voters LEFT JOIN classes ON voters.class_id=classes.id";
                    $result = $conn->query($query);
                    $i=1;
					while($row = $result->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$i."</td>
                          <td hidden>".$row['voter_id']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['class_name']."</td>
                          <td>".strtoupper($row['reg_no'])."</td>
                          <td>".$row['email_id']."</td>
                          <td><a class='edit_voter' title='Edit Voter' data-id='".$row['reg_no']."' data-toggle='tooltip' ><i class='fas fa-edit'></i></a>
						      <a class='delete_voter' title='Delete Voter' data-id='".$row['reg_no']."' data-toggle='tooltip'><i class='fas fa-trash-alt'></i></a>
                          </td>
                        </tr>";
                    $i++;
					}
                  ?>
                </tbody>
            </table>
    </div>
    <div class="box">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_voter_modal"><i
                class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Voter</button>
    </div>

    <div class="modal fade" id="add_voter_modal" tabindex="-1" role="dialog" aria-labelledby="add_voter_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Voter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="./includes/add_voter.php" method="POST" id="add_voter">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">First Name</span>
                                </div>
                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Last Name</span>
                                </div>
                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Class</span>
                                </div>
                                <select class="form-control" id="clas" name="clas" required>
                                    <option value="none" selected disabled>Select an option</option>
                                    <?php $query="SELECT * FROM classes ";
                                          $result=$conn->query($query);
                                          while($c_row=$result->fetch_assoc()){
                                            echo"<option value='".$c_row['id']."'>".$c_row['class_name']."</option>";
                                          }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Register Number</span>
                                </div>
                                <input type="text" class="form-control" name="reg_no" id="reg_no" onchange="checkFormData()" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Email ID</span>
                                </div>
                                <input type="email" class="form-control" name="email_id" id="email_id" onchange="checkFormData()" required>
                            </div>
                            <div id="form-result">

                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="window.location.reload();">Close</button>
                    <button type="submit" form="add_voter" class="btn btn-primary" name="add_voter" id="form-submit"
                        disabled><i class="fa fa-plus" aria-hidden="true"></i> Add Voter</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_voter_modal" tabindex="-1" role="dialog" aria-labelledby="edit_voter_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Voter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="voter_details" method="POST" action="./includes/edit_voter.php">
                        <input type="hidden" class="voter-id" name="voter-id">
                        <input type="hidden" class="voter-reg-no" name="reg_no">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">First Name</span>
                            </div>
                            <input type="text" class="form-control" name="edit_firstname" id="edit_firstname" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Last Name</span>
                            </div>
                            <input type="text" class="form-control" name="edit_lastname" id="edit_lastname" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Class Name</span>
                            </div>
                            <select class="form-control" id="edit_class" name="edit_class" required>
                                <option value="none" disabled>Select an option</option>
                                <?php $query="SELECT * FROM classes ";
                                    $result=$conn->query($query);
                                    while($c_row=$result->fetch_assoc()){
                                      echo"<option value='".$c_row['id']."'>".$c_row['class_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Register Number</span>
                            </div>
                            <input type="text" class="form-control" name="edit_reg_no" id="edit_reg_no" onchange="checkEdits()" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email ID</span>
                            </div>
                            <input type="email" class="form-control" name="edit_email_id" id="edit_email_id" onchange="checkEdits()" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Password</span>
                            </div>
                            <input type="password" class="form-control" name="edit_password" id="edit_password" required>
                        </div>
                        <div id="edit-result">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="voter_details" class="btn btn-primary" id="edit-submit"
                        name="save_details">Update</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete_voter_modal" tabindex="-1" role="dialog" aria-labelledby="delete_voter_modal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Voter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete_voter" class="forms-body" method="POST" action="./includes/delete_voter.php">
                        <input type="hidden" class="voter-id" name="voter-id">
                        <input type="hidden" class="voter-reg-no" name="reg_no">
                        <div class="text-center">
                            <h2></h2>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="delete_voter" class="btn btn-primary" name="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="file_select" tabindex="-1" role="dialog" aria-labelledby="file_select_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select .xls/.xlsx file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" id="file-upload-input" accept=".xls,.xlsx">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="processExcel()">View</button>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <h5>Add Multiple Voters</h5>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Select Class</span>
            </div>
            <select class="form-control" id="class-for-multiple" name="clas" required>
                <option value="none" selected disabled>Select an option</option>
                <?php $query="SELECT * FROM classes ";
                      $result=$conn->query($query);
                      while($c_row=$result->fetch_assoc()){
                        echo"<option value='".$c_row['id']."'>".$c_row['class_name']."</option>";
                      }
                ?>
            </select>
       </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#file_select" id="excel_btn" disabled><i
                class="fa fa-plus" aria-hidden="true" ></i> Excel file</button>
		<a href="./files/file-format.xlsx" style="text-decoration:none; color:black;"download>&nbsp;&nbsp;<i class="fas fa-file-download"></i>&nbsp;Download Excel file format</a>
    </div>
    <div class="box">
        <button id="check-button" class="btn btn-primary btn-sm" onclick="checkRowData()">Check</button>
        <button id="table-upload-button" class="btn btn-primary btn-sm" onclick="uploadRowData()" disabled>Upload</button>
    </div>

    <div class="box excel-to-table" id="excel-to-tabel-box" hidden>
        <div class="box-body">
                <table class="table table-striped table-bordered table-hover table-sm  table-responsive-sm" id="excel-to-table" width="100%">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Register Number</th>
                        <th>Email ID</th>
                        <th>Actions</th>
                    </thead>
                    <tbody id="table-body">

                    </tbody>
                </table>
                <div id="table-result">
                </div>

        </div>
    </div>
</div>
<div class="modal mymodal"></div>
<style>
.mymodal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .4 ) 
                url('./image_sources/pulse.gif') 
                50% 50% 
                no-repeat;
}

body.loading {
    overflow: hidden;   
}

body.loading .mymodal {
    display: block;
}

.table td .add {
    display: none;
}

.table td a {
    cursor: pointer;
    display: inline-block;
    margin: 0 5px;
    min-width: 24px;
}

.table td a.add {
    color: #27C46B;
}

table td a.edit,
a.edit_voter {
    color: #FFC107;
}

table.table td a.delete,
a.delete_voter {
    color: #E34724;
}

table.table td i {
    font-size: 19px;
}

table.table td a.add i {
    font-size: 24px;
    margin-right: -1px;
    position: relative;
    top: 3px;
}
.excel-to-table{
    margin-bottom: 40px;
    overflow-y: scroll !important;
    height: 300px;
}
</style>
<script type="text/javascript">
function processExcel() {
    $('#file_select').modal('hide');
    $('#excel-to-tabel-box').attr("hidden", false);
    var fileUpload = document.getElementById("file-upload-input");
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
    if (regex.test(fileUpload.value.toLowerCase())) {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            if (reader.readAsBinaryString) {
                reader.onload = function(e) {
                    viewExcel(e.target.result);
                };
                reader.readAsBinaryString(fileUpload.files[0]);
            } else {
                reader.onload = function(e) {
                    var data = "";
                    var bytes = new Uint8Array(e.target.result);
                    for (var i = 0; i < bytes.byteLength; i++) {
                        data += String.fromCharCode(bytes[i]);
                    }
                    viewExcel(data);
                };
                reader.readAsArrayBuffer(fileUpload.files[0]);
            }
        } else {
            alert("This browser does not support HTML5.");
        }
    } else {
        alert("Please upload a valid Excel file.");
    }
};

function viewExcel(data) {
    var workbook = XLSX.read(data, {
        type: 'binary'
    });
    var tbl_body = document.getElementById("table-body");
    for (var i = 0; i < workbook.SheetNames.length; i++) {
        var sheet = workbook.SheetNames[i];
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
        for (var j = 0; j < excelRows.length; j++) {
            var row = tbl_body.insertRow(-1);
            var cell = row.insertCell(-1);
            cell.innerHTML = excelRows[j].First_name;
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[j].Last_name;
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[j].Registration_number;
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[j].Email_id;
            cell = row.insertCell(-1);
            cell.innerHTML =
                '<a class="add" title="Add" data-toggle="tooltip"><i class="fas fa-plus-square"></i></a><a class="edit" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a><a class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a>'
        }
    }
};

$(document).on("click", ".add", function() {
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
    input.each(function() {
        if (!$(this).val()) {
            $(this).addClass("error");
            empty = true;
        } else {
            $(this).removeClass("error");
        }
    });
    $(this).parents("tr").find(".error").first().focus();
    if (!empty) {
        input.each(function() {
            $(this).parent("td").html($(this).val());
        });
        $(this).parents("tr").find(".add, .edit").toggle();
    }
});

$(document).on("click", ".edit", function() {
    $(this).parents("tr").find("td:not(:last-child)").each(function() {
        $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    });
    $(this).parents("tr").find(".add, .edit").toggle();
});

$(document).on("click", ".delete", function() {
    $(this).parents("tr").remove();
});

function checkFormData() {
    $('#form-result').html('');
    var email_id = $("#email_id").val();
	if(email_id==""){
		$('#form-submit').prop('disabled', true);
		return;
	}
    const reg = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
    var reg_no = $("#reg_no").val();
    if (reg.test(String(email_id).toLowerCase())) {
        $.post('./includes/check_voter.php', {
                'email_id': email_id,
                'reg_no': reg_no,
            },
            function(data) {
                if (data == "success") {
                    $('#form-result').html('<div class="alert alert-success" role="alert">Voter Not Present</div>');
                    $('#form-submit').prop('disabled', false);
                } else if (data == "warning") {
                    $('#form-result').html('<div class="alert alert-danger" role="alert">Invalid Email</div>');
                    $('#form-submit').prop('disabled', true);
                } else {
                    $('#form-result').html(
                        '<div class="alert alert-danger" role="alert">Register Number / Email ID is already registered.</div>');
                    $('#form-submit').prop('disabled', true);
                }
            });
    } else {
        alert('Invalid Email');
        $('#form-submit').prop('disabled', true);
    }
}

function checkEdits() {
    $('#edit-result').html('');
	const reg = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
    var email_id = $('#edit_email_id').val();
    var voter_id = $('.voter-id').val();
    var voter_reg_no = $('.voter-reg-no').val();
    var reg_no = $("#edit_reg_no").val();
    if (reg.test(String(email_id).toLowerCase())) {
        $.post('./includes/check_voter.php', {
                'voter_id': voter_id,
                'voter_reg_no': voter_reg_no,
                'email_id': email_id,
                'reg_no': reg_no,
            },
            function(data) {
                if (data == "success") {
                    $('#edit-result').html('');
                    $('#edit-submit').prop('disabled', false);
                } else if (data == "warning"){
                    $('#edit-result').html('<div class="alert alert-danger" role="alert">Invalid Email</div>');
                    $('#edit-submit').prop('disabled', true);
                } else if(data=="danger"){
                    $('#edit-result').html('<div class="alert alert-danger" role="alert">Register Number / Email ID is already registered.</div>');
                    $('#edit-submit').prop('disabled', true);
                }
            });
    } else {
        alert('Invalid Email');
        $('#form-submit').prop('disabled', true);
    }
}

function checkRowData() {
    $('#table-result').html('');
    var emailData = [],regData = [];
    const reg = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
    var table = document.getElementById("excel-to-table");
    var length = table.rows.length - 1;
    for (var i = 1; i <= length; i++) {
        let row = table.rows[i];
        var reg_no = row.cells[2].innerHTML;
        var email_id = row.cells[3].innerHTML;
        if (!reg.test(String(email_id).toLowerCase())) {
            $('#table-result').append('<div class="alert alert-danger" role="alert">' + reg_no +
                ' has an invalid Email ID</div>');
            $('#table-upload-button').prop('disabled', true);
        } else {
            emailData.push(email_id);
            regData.push(reg_no);
        }
    }
    if (emailData.length == regData.length) {
        $.ajax({
            url: "./includes/check_multiple_voters.php",
            method: "POST",
            data: {
                'regData': regData,
                'emailData': emailData
            },
            success: function(data) {
                var data = $.parseJSON(data);
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html = html + data[i] + ', ';
                }
                if (html != '') {
                    $("#table-result").append('<div class="alert alert-danger" role="alert">' + html +
                        ' Register Number / Email ID is already registered.</div>');
                    $('#table-upload-button').prop('disabled', true);
                } else {
                    $('#table-upload-button').prop('disabled', false);
                }
            }
        });
    }
}
function uploadRowData() {
  $body = $("body");
  $('#table-result').html('');
  var classID=$('#class-for-multiple').val();
  console.log(classID);
  var firstName=[],lastName=[],emailData = [],regData = [];
  var table = document.getElementById("excel-to-table");
  var length = table.rows.length - 1;
  for (var i = 1; i <= length; i++) {
    let row = table.rows[i];
    firstName.push(row.cells[0].innerHTML);
    lastName.push(row.cells[1].innerHTML);
    regData.push(row.cells[2].innerHTML);
    emailData.push(row.cells[3].innerHTML);
  }
  if(emailData.length == regData.length) {
        $.ajax({
            url: "./includes/upload_multiple_voters.php",
            method: "POST",
            data: {
                'classID':classID,
                'firstName':firstName,
                'lastName':lastName,
                'regData': regData,
                'emailData': emailData
            },
            beforeSend: function() { $body.addClass("loading"); },
            complete: function() {$body.removeClass("loading"); },
            success: function(data) {
              if(data=="error"){
               alert('Error while processing data!!!!Please try again after reloading the page.');
              }
              else if(data=="warning"){
                alert('Please Choose your class');
              }
              else{
                  var data = $.parseJSON(data);
                  var html = '';
                  for (var i = 0; i < data.length; i++) {
                      html = html + data[i] + ', ';
                  }
                  if (html != '') {
                      $("#table-result").append('<div class="alert alert-danger" role="alert"> Error while uploading voter(s)' + html +'</div>');
                  } else {
                    $("#table-result").append('<div class="alert alert-danger" role="alert">All voters were added successfuly. You can reload the page to view the changes.</div>');
                  }
              }
          }
        });
    }
}


$(document).ready(function() {
    $(document).on('click', '.edit_voter', function() {
        $('#edit-result').html('');
        var reg_no = $(this).data('id');
        var tr = $(this).closest('tr');
        var voter_id = $(tr).find('td').eq(1).text();
        $('#edit_voter_modal').modal('show');
        getVoterRow(voter_id, reg_no);
    });

    $(document).on('click', '.delete_voter', function() {
        var reg_no = $(this).data('id');
        var tr = $(this).closest('tr');
        var voter_id = $(tr).find('td').eq(1).text();
        $('#delete_voter_modal').modal('show');
        getVoterRow(voter_id, reg_no);
    });
});

function getVoterRow(voter_id, reg_no) {
    $.ajax({
        type: 'POST',
        url: './includes/get_voter_info.php',
        data: {
            id: voter_id,
            reg_no: reg_no
        },
        dataType: 'JSON',
        success: function(response) {
            $('.voter-reg-no').val(response.reg_no);
            $('.voter-id').val(response.voter_id);
            $('#edit_firstname').val(response.firstname);
            $('#edit_lastname').val(response.lastname);
            $('#edit_class').val(response.class_id);
            $('#edit_reg_no').val(response.reg_no.toUpperCase());
            $('#edit_email_id').val(response.email_id);
            $('#edit_password').val(response.password);
            $('#delete_voter h2').html(response.reg_no.toUpperCase());
        }
    });
}
$(document).ready(function(){
	$('#class-for-multiple').val("none");
	$('#clas').val("none");
	
	$('#class-for-multiple').change(function(){
		var selectVal=$('#class-for-multiple').val();
		if(selectVal=="none"){
			$('#excel_btn').prop('disabled',true);
		}
		else{
			$('#excel_btn').prop('disabled',false);
		}
	});
	
	$('#clas').change(function(){
		var selectVal=$('#clas').val();
		if(selectVal=="none"){
			$('#form-submit').prop('disabled',true);
		}
		else{
			$('#form-submit').prop('disabled',false);
		}
	});
	
    $('#voters_table').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all rows']
        ],
        buttons: [
            {
                extend: 'pageLength',
                className:'btn-light'
                
            },
            {
                extend: 'copyHtml5',
                className:'btn-light',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6]
                },
                title: 'Voters Table'
            },
            {
                extend: 'excelHtml5',
                className:'btn-light',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6]
                },
                title: 'Voters Table'
            },
            {
                extend: 'pdfHtml5',
                className:'btn-light',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6]
                },
                title: 'Voters Table'
            },
            {
                extend: 'print',
                className:'btn-light',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6]
                },
                title: 'Voters Table'
            },
        ],
    });
});
</script>
</body>

</html>