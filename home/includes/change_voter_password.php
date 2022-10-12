<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		if(isset($_POST['change-password-submit'])){
			$voter_id= $_POST['voter-id'];
			$reg_no= $_POST['reg-no'];
			$old_password= $_POST['old_password'];
			$new_password= $_POST['new_password'];
			$confirm_password= $_POST['confirm_password'];
			$query = "SELECT * FROM voters WHERE reg_no = '$reg_no' AND voter_id='$voter_id'";
			$result = $conn->query($query);
			$row = $result->fetch_assoc();
			if($new_password== $confirm_password){
				if(password_verify($old_password, $row['password'])){
					$password=password_hash($new_password,PASSWORD_DEFAULT);
					$query ="UPDATE voters SET password='$password' WHERE reg_no = '$reg_no' AND voter_id='$voter_id'"; 
					$result=$conn->query($query);
					if($result){
						session_destroy();
						echo"<script type='text/javascript'>alert('Password updated successfully');window.location.href='../index.php';</script>";	
					} 
					else{
						echo"<script type='text/javascript'>alert('Error while updating');window.location.href='../votepage.php';</script>";
					}
				}
				else{
					echo"<script type='text/javascript'>alert('Your old password was incorrect');window.location.href='../votepage.php';</script>";
				}	
			}
			else{
				echo"<script type='text/javascript'>alert('Passwords do not Match');window.location='../votepage.php';</script>";
				exit();	
			}
		}
		else{
			header('Location: ../votepage.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>

