<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="admin.php"><i
                        class="fas fa-users"></i>&nbsp;<span>Administrator Settings</span></a>
        </ol>
    </nav>

    <div class="box">
        <div class="box-header">
            <h5>Admin List</h5>
        </div>
            <table class="table table-striped table-bordered table-hover table-sm  table-responsive-sm" id="admin_table" width="100%">
                <thead>
                    <th>Sl. No</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email ID</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM admin";
                    $result = $conn->query($query);
                    $i=1;
					while($row = $result->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".strtolower($row['username'])."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['email_id']."</td>
                          <td><a class='deleteAdmin' title='Delete Admin' data-id='".$row['admin_id']."' data-toggle='tooltip'><i class='fas fa-trash-alt'></i></a>
                          </td>
                        </tr>";
                    $i++;
					}
                  ?>
                </tbody>
            </table>
    </div>
    <div class="box">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal"><i
                class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New Admin</button>
    </div>

    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="./settings/create_admin.php" method="POST" id="createAdmin">
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
                                    <span class="input-group-text">Username</span>
                                </div>
                                <input type="text" class="form-control" name="username" id="username" onchange="checkFormData()" pattern="[a-z_.@0-9]+" required>
                            </div>
                            <p class="text-danger">Username can only contain lowercase letters,numbers[0-9] and special chracters(_.@)</p>
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
                        onclick="window.location.href='admin.php'">Close</button>
                    <button type="submit" form="createAdmin" class="btn btn-primary" name="create-admin" id="form-submit"
                        disabled><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete_admin" method="POST" action="./settings/delete_admin.php">
                        <input type="hidden" class="adminID" name="adminID">
                        <input type="hidden" class="userName" name="userName">
                        <div class="text-center">
                            <h4></h4>
                        </div>
                        <p class="text-danger">*Enter you password to continue.</p>
                        <div class="input-group mb-3">
				            <div class="input-group-prepend">
							    <span class="input-group-text">Confirm Identity</span>
				            </div>
				            <input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		                </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="delete_admin" class="btn btn-primary" name="delete-admin">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSelfModal" tabindex="-1" role="dialog" aria-labelledby="deleteSelfModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete your account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete_admin_self" method="POST" action="./settings/delete_admin.php">
                        <input type="hidden" class="adminID" name="adminID">
                        <input type="hidden" class="userName" name="userName">
                        <div class="text-center">
                            <h4></h4>
                        </div>
                        <p class="text-danger">*Enter you password to continue.</p>
                        <div class="input-group mb-3">
				            <div class="input-group-prepend">
							    <span class="input-group-text">Confirm Identity</span>
				            </div>
				            <input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		                </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="delete_admin_self" class="btn btn-primary" name="delete-self">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.table td a {
    cursor: pointer;
    display: inline-block;
    margin: 0 5px;
    min-width: 24px;
}


table td a.editAdmin {
    color: #FFC107;
}

table.table a.deleteAdmin {
    color: #E34724;
}

table.table td i {
    font-size: 19px;
}
</style>

<script type="text/javascript">

function checkFormData() {
    $('#form-result').html('');
    var email_id = $("#email_id").val();
	if(email_id==""){
		$('#form-submit').prop('disabled', true);
		return;
	}
    const reg = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
    var username = $("#username").val();
    if (reg.test(String(email_id).toLowerCase())) {
        $.post('./settings/check_admin_data.php', {
                'new_email_id': email_id,
                'new_username': username,
            },
            function(data) {
                if (data == "success") {
                    $('#form-result').html('');
                    $('#form-submit').prop('disabled',false);
                } else if (data == "warning") {
                    $('#form-result').html('<div class="alert alert-danger" role="alert">Username or Email ID is already taken</div>');
                    $('#form-submit').prop('disabled',true);
                } else {
                    $('#form-result').html('<div class="alert alert-danger" role="alert">Empty fields</div>');
                    $('#form-submit').prop('disabled',true);
                }
            });
    } else {
        alert('Invalid Email');
        $('#form-submit').prop('disabled', true);
    }
}

$(document).ready(function() {
    $(document).on('click', '.deleteAdmin', function() {
        var adminID = $(this).data('id');
        var tr = $(this).closest('tr');
        var userName = $(tr).find('td').eq(1).text();
        var sessionAdminUserName= "<?php echo $_SESSION['admin-username'];?>";
        var sessionAdminID= "<?php echo $_SESSION['admin-id'];?>";
        if(userName==sessionAdminUserName && sessionAdminID==adminID){
            $('.adminID').val(sessionAdminID);
            $('.userName').val(sessionAdminUserName);
            $('#delete_admin_self h4').html(sessionAdminUserName);
            $('#deleteSelfModal').modal('show');
        }
        else{
            $('.adminID').val(adminID);
            $('.userName').val(userName);
            $('#delete_admin h4').html(userName);
            $('#deleteAdminModal').modal('show');
        }
    });
});

$(document).ready(function(){
    $('#admin_table').DataTable();
});
</script>
</body>

</html>