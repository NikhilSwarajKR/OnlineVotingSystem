<?php
	require './connection.php';
	require './mail_sender.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['add_voter'])){
			$first_name = ucfirst(strtolower($_POST['first_name']));
			$last_name=ucfirst(strtolower($_POST['last_name']));
			$class_id=$_POST['clas'];
			$reg_no=strtolower($_POST['reg_no']);
			$email_id=strtolower($_POST['email_id']);
			if(filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$query="SELECT * FROM voters WHERE reg_no='$reg_no' OR email_id='$email_id'";
				$result=$conn->query($query);
				if($result->num_rows>0){
					$text=$reg_no." is already a voter.";
					echo"<script type='text/javascript'>alert('$text');window.location.href='../voters.php';</script>";
					exit();
				}
				else{
					$set = '@$&_123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$password = substr(str_shuffle($set), 0, 12);
					$password_hashed = password_hash($password,PASSWORD_DEFAULT);
					$query = "INSERT INTO voters (firstname, lastname, class_id, reg_no, email_id, password) VALUES ('$first_name', '$last_name','$class_id', '$reg_no','$email_id', '$password_hashed')";
					if($conn->query($query)){
						$flag=send_voter_credentials($email_id,$reg_no,$password);
						sleep(1);
						if($flag){
						echo"<script type='text/javascript'>alert('Voter added Successfully.');window.location.href='../voters.php';</script>";
						}
					}
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Invalid Email');window.location.href='../voters.php';</script>";
			}  
		}
	}
	else{
		header('Location: ../index.php');
	}
?>