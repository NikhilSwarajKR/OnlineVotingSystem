<?php require 'connection.php';
	session_start();
	if(!(isset($_SESSION['admin-username']))){
		header('Location: ./index.php');
	}else{
		$admin_username=$_SESSION['admin-username'];
		$admin_id=$_SESSION['admin-id'];
	}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
		<title>Admin Panel</title>
		<link rel="stylesheet" href="./styles/style.css">
		<link rel="stylesheet" href="./../sources/bootstrap-4.6.0/css/bootstrap.css">
		<link rel="stylesheet" href="./../sources/fontawesome-free-5.15.3-web/css/all.min.css">
		<link rel="stylesheet" href="./../sources/datatables/datatables-1.10.24/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" href="./../sources/datatables/buttons-1.7.0/css/buttons.bootstrap4.css">
		<link rel="stylesheet" href="./../sources/jquerydatetimepicker/jquery.datetimepicker.css">
		<script type="text/javascript" src="./../sources/jquery-3.6.0/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="./../sources/jquerydatetimepicker/jquery.datetimepicker.full.min.js"></script>
		<script type="text/javascript" src="./../sources/momentjs/moment.min.js"></script>

		<script src="./../sources/Bootstrap-4.6.0/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="./../sources/charts/chart.min.js"></script>
		<script type="text/javascript" src="./../sources/xlsx/xlsx.full.min.js"></script>

		<script type="text/javascript" src="./../sources/datatables/datatables.min.js"></script>
		<script type="text/javascript" src="./../sources/datatables/datatables-1.10.24/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="./../sources/datatables/buttons-1.7.0/js/buttons.bootstrap4.min.js"></script>

		<script type="text/javascript" src="./../sources/datatables/pdfmake.min.js"></script>
		<script type="text/javascript" src="./../sources/datatables/vfs_fonts.js"></script>
		
	</head>
<body>
<input type="checkbox" id="check" hidden>
<nav class="nav-bar ">
	<label for="check"><i class="fas fa-bars" id="sidebar_btn"></i></label>
    <div class="left_area">
			<?php
				$query = "SELECT title FROM election_title WHERE 1";
				$result = $conn->query($query);
				$row=$result->fetch_assoc();
				echo "<p>".$row['title']."</p>";
			?>
    </div>
    <ul class="right_area">
        <li class="nav-item dropdown">
        <a class="dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="./image_sources/profile.png" class="rounded-circle dropdown" width="35" height="35"></a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
				<img src="./image_sources/profile.png" class="rounded-circle dropdown" width="60" height="60" >
				<?php  
					$query="SELECT * FROM admin WHERE admin_id='$admin_id' AND username='$admin_username'";
					$result=$conn->query($query);
					while($row=$result->fetch_assoc()){
						echo "<p style='margin:0px;'>".$row['username']."</p>";
						echo "<p style='margin:0px;'>".$row['email_id']."</p>";
					}
				?>
				<a class="dropdown-item waves-effect waves-light " href="#account_settings_modal" data-toggle="modal" data-target="#account_settings_modal" style=" border-top: 1px solid #808080;"><i class="fas fa-user-cog" aria-hidden="true" ></i>&nbsp; Account Settings</a>
				<a class="dropdown-item waves-effect waves-light" href="./logout.php" name="logout"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>&nbsp; Logout</a>              
            </div>
    	</li>       
    </ul>
</nav>


	<div class="sidebar">
		<a href="home.php" data-toggle="tooltip" title="Dashboard" data-placement="right"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
		<a href="votes.php" data-toggle='tooltip' title="Votes" data-placement="right"><i class="fas fa-vote-yea"></i><span>Votes</span></a>
		<a href="voters.php"data-toggle="tooltip" title="Voters" data-placement="right"><i class="fas fa-users"></i><span>Voters</span></a>
		<a href="positions.php" data-toggle="tooltip" title="Positions" data-placement="right"><i class="fas fa-tasks"></i><span>Positions</span></a>
		<a href="candidates.php" data-toggle="tooltip" title="Candidates" data-placement="right"><i class="fas fa-user-tie"></i><span>Candidates</span></a>
		<a href="ballot.php" data-toggle="tooltip" title="Ballot Settings" data-placement="right"><i class="fas fa-sliders-h"></i><span>Ballot Settings</span></a>
		<a href="admin.php" data-toggle="tooltip" title="Administrator Settings" data-placement="right"><i class="fas fa-users-cog"></i><span>Admin Settings</span></a>
	</div>
	
	<div class="modal fade" id="account_settings_modal" tabindex="-1" role="dialog" aria-labelledby="account_settings_modal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Settings</h5>
		  </div>
		  <div class="modal-body">
		  <?php
				$query = "SELECT * FROM admin WHERE admin_id='$admin_id' AND username='$admin_username'";
				$result = $conn->query($query);
				$row = $result->fetch_assoc(); 
		  ?>
				<form id="admin_update" action="./settings/admin_update_without_password.php" method="POST">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text">First Name</span>
						</div>
						<input type="text" class="form-control" name="first_name" id="admin_first_name" value="<?php echo $row['firstname']; ?>" required>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text" >Last Name</span>
						</div>
						<input type="text" class="form-control" name="last_name" id="admin_last_name" value="<?php echo $row['lastname']; ?>" required>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text" >Username</span>
						</div>
						<input type="text" class="form-control" name="username" id="admin_username" value="<?php echo $row['username']; ?>" onchange="checkUsername()" pattern="[a-z_.@0-9]+" required>
					</div>
					<p class="text-danger">Username can only contain lowercase letters,numbers[0-9] and special chracters(_.@)</p>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text" >Email ID</span>
						</div>
						<input type="email" class="form-control" name="admin_email" id="admin_email" value="<?php echo $row['email_id']; ?>" onchange="checkUsername()" required>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="check-box">
						<label class="form-check-label" for="check-box">Change Password</label>
					</div>

					
					<div id="form-check-content" hidden>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text">Old Password</span>
						</div>
						<input type="password" class="form-control" placeholder="Enter your old password" name="old_password" id="old_password">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text">New Password</span>
						</div>
						<input type="password" class="form-control" placeholder="Enter your new password" name="new_password" id="new_password" onchange="checkPassword()" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
					</div><div class="input-group mb-3">
						<div class="input-group-prepend">
								 <span class="input-group-text">New Password</span>
						</div>
						<input type="password" class="form-control" placeholder="Re-enter your new password" name="re_entered_password" id="re_entered_password" onchange="checkPassword()" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
					</div>
					<p class="text-danger"> Password should have ,minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</p>
					</div>
					<div id="result">

					</div>
				</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">Close</button>
			<button type="submit" form="admin_update" class="btn btn-primary" name="admin_set_update" id="admin_set_update">Save</button>
		  </div>
		</div>
	  </div>
	</div>
<script type="text/javascript">
	$("#check-box").click(function () {
		if ($(this).is(":checked")) {
			$("#form-check-content").prop('hidden',false);
			$("#form-check-content input[type=password]").val('');
			$("#form-check-content input[type=password]").attr('required',true);
			$("#admin_update").attr('action','./settings/admin_update_with_password.php');
		} else {
			$("#form-check-content").prop('hidden',true);
			$("#form-check-content input[type=password]").attr('required',false);
			$("#admin_update").attr('action','./settings/admin_update_without_password.php');
			$('#admin_set_update').prop('disabled',false);
			$('#result').html('');
		}
	});
	
	function checkUsername(){
		var email_id = $("#admin_email").val();
		var username = $("#admin_username").val();
		const reg = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
		if (reg.test(String(email_id).toLowerCase())){
			$.post('./settings/check_admin_data.php',{
					'email_id': email_id,
					'username': username,
				},
				function(data) {
					if (data == "success") {
						$('#result').html('');
						$('#admin_set_update').prop('disabled',false);
					} else if (data == "warning") {
						$('#result').html('<div class="alert alert-danger" role="alert">Username or Email ID is already taken</div>');
						$('#admin_set_update').prop('disabled',true);
					} else {
						$('#result').html('<div class="alert alert-danger" role="alert">Empty fields</div>');
						$('#admin_set_update').prop('disabled',true);
					}
			});
		} else {
			alert('Invalid Email');
			$('#admin_set_update').prop('disabled',true);
		}
	}
	
	function checkPassword(){
		var new_password=$("#new_password").val();
	    var re_entered_password=$("#re_entered_password").val();
		if(re_entered_password=="" || new_password==""){
			return;
		}
		if(new_password!=re_entered_password){
		    $('#result').html('<div class="alert alert-danger" role="alert">Passwords do not match</div>');
			$('#admin_set_update').prop('disabled',true);
		}
		else{
		    $('#result').html('<div class="alert alert-success" role="alert">Passwords match</div>');
			$('#admin_set_update').prop('disabled',false);
		}
	}
	
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip({
			delay: { "show":1000}
		});
	})
</script>
	