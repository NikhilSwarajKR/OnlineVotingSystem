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
				$c_query = "DELETE FROM classes WHERE 1";
				$t_query="DELETE FROM timings WHERE 1";
				$v_query = "DELETE FROM voters WHERE 1";
				$c_result=$conn->query($c_query);
				$t_result=$conn->query($t_query);
				$v_result=$conn->query($v_query);
				if($c_result && $t_result && $v_result){
					echo"<script type='text/javascript'>alert('All classes deleted successfully');window.location.href='../ballot.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while deleting the classes.');window.location.href='../ballot.php';</script>";
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