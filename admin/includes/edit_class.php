<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['edit-class-submit'])&& isset($_POST['class_id'])){
			if(!empty($_POST['class_name'])){
				$class_id=$_POST['class_id'];
				$class_name=strtoupper($_POST['class_name']);
				$start_time=$_POST['start_time'];
				$end_time=$_POST['end_time'];
				$cu_query="UPDATE classes SET class_name='$class_name' WHERE id='$class_id'";
				$cu_result=$conn->query($cu_query);
				if($cu_result){
					$t_query="UPDATE timings SET start_time='$start_time',end_time='$end_time' WHERE class_id='$class_id'";
					$t_result=$conn->query($t_query);
					if($t_result){
						echo"<script type='text/javascript'>alert('Class details updated successfully');window.location='../ballot.php';</script>";	
					}
				}
				else{
					echo"<script type='text/javascript'>alert('Error while updating class details');window.location='../ballot.php';</script>";	
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Class name is empty');window.location='../ballot.php';</script>";	
			}
		}
		else{
			echo"warning";
			header('location: ../ballot.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>