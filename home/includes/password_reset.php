<?php
	require './connection.php';
	function resetVoterPasswordSendMail($email_id,$password){
		$to_mail=$email_id;
		$message="Dear Student your new password is as mentioned below."."\nYour Password:  ".$password."\n\nThank You";
		$subject="Password successfully reset!!!!";
		$headers="From: voters.credentials@gmail.com";
		if(mail($to_mail,$subject,$message,$headers)){
			return true;
		}
		else{
			return false;
		}
	}

	if(isset($_POST['reset-password'])){
		if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['regNo']) && !empty($_POST['emailID'])){
			$firstName=ucfirst(trim(strtolower($_POST['firstName'])));
			$lastName=ucfirst(trim(strtolower($_POST['lastName'])));
			$regNo=strtolower(trim($_POST['regNo']));
			$emailID=strtolower(trim($_POST['emailID']));
			if(filter_var($emailID, FILTER_VALIDATE_EMAIL)){
				$getQuery="SELECT firstname,lastname,email_id FROM voters WHERE reg_no='$regNo' AND email_id='$emailID'";
				$getResult=$conn->query($getQuery);
				$count=$getResult->num_rows;
				$getRow=$getResult->fetch_assoc();
				if($count==1){
					if(ucfirst(strtolower($getRow['firstname']))==$firstName){
						if(ucfirst(strtolower($getRow['lastname']))==$lastName){
							$set = '@$&_123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$password = substr(str_shuffle($set), 0, 12);
							$password_hashed = password_hash($password,PASSWORD_DEFAULT);
							$flag=resetVoterPasswordSendMail($getRow['email_id'],$password);
							sleep(2);
							if($flag){
								echo"<script type='text/javascript'>alert('Mail sent successfully.');</script>";
								$update_query = "UPDATE voters SET password = '$password_hashed' WHERE reg_no = '$regNo' AND email_id='$emailID'";
								if($conn->query($update_query)){
									echo"<script type='text/javascript'>;window.location.href='../index.php';</script>";	
								}
							}
							else{
								echo"<script type='text/javascript'>alert('Failed to send mail. Try again later');window.location.href='../forgot-password.php';</script>";
							}
						}
						else{
							echo"<script type='text/javascript'>alert('Please Check your name.');window.location.href='../forgot-password.php';</script>";
						}
					}
					else{
						echo"<script type='text/javascript'>alert('Please Check your name.');window.location.href='../forgot-password.php';</script>";
					}
				}
				else{
					echo"<script type='text/javascript'>alert('Invalid Credentials');window.location.href='../forgot-password.php';</script>";
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Invalid Email');window.location.href='../forgot-password.php';</script>";
			} 
		}
		else{
			header('Location: ../forgot-password.php');
		}
	}
	else{
		header('Location: ../forgot-password.php');
	}
?>