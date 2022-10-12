<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['delete-class-submit'])){
			if(isset($_POST['class_id'])){
				$class_id=$_POST['class_id'];
				$c_query="DELETE FROM classes WHERE id='$class_id'";
				$t_query="DELETE FROM timings WHERE class_id='$class_id'";
				$v_query="DELETE FROM voters WHERE class_id='$class_id'";
				$c_result=$conn->query($c_query);
				$t_result=$conn->query($t_query);
				$v_result=$conn->query($v_query);
				if($c_result && $t_result && $v_result){
					echo"<script type='text/javascript'>alert('Class deleted successfully.');window.location.href='../ballot.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while deleting the class.');window.location.href='../ballot.php';</script>";
				}
			}
		}
		else{
			echo "error";
			header('location: ../ballot.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>