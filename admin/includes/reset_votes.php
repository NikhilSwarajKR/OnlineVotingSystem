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
				$vv_query = "DELETE FROM voters_voted WHERE 1";
				$up_query="UPDATE candidate_votes SET c_votes=0 WHERE 1";
				$vv_result=$conn->query($vv_query);
				$up_result=$conn->query($up_query);
				if($vv_result && $up_result){
					echo"<script type='text/javascript'>alert('Reset done successfully.');window.location.href='../ballot.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while reseting.');window.location.href='../ballot.php';</script>";
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