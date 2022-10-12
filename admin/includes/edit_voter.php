<?php
	require './connection.php';
	require './mail_sender.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['save_details'])){
			$voter_id= $_POST['voter-id'];
			$reg_no= $_POST['reg_no'];
			$firstname = ucfirst(strtolower($_POST['edit_firstname']));
			$lastname = ucfirst(strtolower($_POST['edit_lastname']));
			$class_id = $_POST['edit_class'];
			$edit_reg_no= strtolower($_POST['edit_reg_no']);
			$email_id = strtolower($_POST['edit_email_id']);
			$password = $_POST['edit_password'];
			if(filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$query = "SELECT * FROM voters WHERE reg_no = '$reg_no' AND voter_id='$voter_id'";
				$result = $conn->query($query);
				$row = $result->fetch_assoc();
				$row_count=$result->num_rows;
				if($row_count==1){
					if($password == $row['password']){
						$password_hashed = $row['password'];
					}
					else{
						$password_hashed = password_hash($password, PASSWORD_DEFAULT);
						$flag=send_voter_credentials($email_id,$reg_no,$password);
						sleep(2);
						if($flag){
						echo"<script type='text/javascript'>alert('Mail sent successfully.');</script>";
						}
					}
					$update_query = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', class_id='$class_id', reg_no='$edit_reg_no', email_id='$email_id', password = '$password_hashed' WHERE reg_no = '$reg_no' AND voter_id='$voter_id'";
					if($conn->query($update_query)){
						echo"<script type='text/javascript'>alert('Voter details updated successfully.');window.location='../voters.php';</script>";	
						
					}
					else{
						echo"<script type='text/javascript'>alert('Error while updating voter details');window.location='../voters.php';</script>";	
					}
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Invalid Email');window.location.href='../voters.php';</script>";
			}
		} 
		else{
			echo "warning";
			header('location: ../voters.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>