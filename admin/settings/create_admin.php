<?php
	require './connection.php';
	session_start();
	function createAdminSendMail($email_id,$username,$password){
		$to_mail=$email_id;
		$message="Dear Admin your credentials are as mentioned below."."\n\nYour Username:  ".$username."\nYour Password:  ".$password."\n\nThank You";
		$subject="Administrator Credentials";
		$headers="From: voters.credentials@gmail.com";
		if(mail($to_mail,$subject,$message,$headers)){
			return true;
		}
		else{
			return false;
		}
	}
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['create-admin'])){
			$first_name = ucfirst(strtolower($_POST['first_name']));
			$last_name=ucfirst(strtolower($_POST['last_name']));
			$username=strtolower($_POST['username']);
			$email_id=strtolower($_POST['email_id']);
			if(filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$query="SELECT * FROM admin WHERE admin_id='$username' OR email_id='$email_id'";
				$result=$conn->query($query);
				if($result->num_rows>0){
					echo"<script type='text/javascript'>alert('Admin Exists!!!!');window.location.href='../admin.php';</script>";
					exit();
				}
				else{
					$set = '@$&_123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$password = substr(str_shuffle($set), 0, 12);
					$password_hashed = password_hash($password,PASSWORD_DEFAULT);
					$query = "INSERT INTO admin (firstname, lastname, username, email_id, password) VALUES ('$first_name', '$last_name','$username','$email_id', '$password_hashed')";
					if($conn->query($query)){
						$flag=createAdminSendMail($email_id,$username,$password);
						sleep(2);
						if($flag){
						echo"<script type='text/javascript'>alert('Admin created Successfully.');window.location.href='../admin.php';</script>";
						}
					}
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Invalid Email');window.location.href='../admin.php';</script>";
			}  
		}
		else{
			header('Location: ../admin.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>