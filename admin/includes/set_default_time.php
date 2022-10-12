<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['default-time-submit'])){
				$start_time=$_POST['default_start_time'];
				$end_time=$_POST['default_end_time'];
				$t_query="UPDATE timings SET start_time='$start_time',end_time='$end_time' WHERE 1";
				$t_result=$conn->query($t_query);
				if($t_result){
					echo"<script type='text/javascript'>alert('Time updated successfully.');window.location='../ballot.php';</script>";	
				}
				else{
					echo"<script type='text/javascript'>alert('Error while updating time');window.location='../ballot.php';</script>";	
				}
		}
		else{
			header('location: ../ballot.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>