<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['password-to-continue']) && isset($_POST['confirm-submit'])){
			$username=$_SESSION['admin-username'];
			$admin_id=$_SESSION['admin-id'];
			$password=$_POST['password-to-continue'];
			$cquery="SELECT password FROM admin WHERE username='$username' AND admin_id='$admin_id'";
			$cresult=$conn->query($cquery);
			$crow=$cresult->fetch_assoc();
			if(password_verify($password,$crow['password'])){
				$pquery = "DELETE FROM positions WHERE 1";
				$presult=$conn->query($pquery);
				if($presult){
					echo"<script type='text/javascript'>alert('All positions were deleted successfully');window.location.href='../ballot.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while deleting positions.');window.location.href='../ballot.php';</script>";
				}	
			}
			else{
				echo"<script type='text/javascript'>alert('Your password does not match');window.location.href='../ballot.php';</script>";
			}
		}
		else{
			header('Location: ../ballot.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>