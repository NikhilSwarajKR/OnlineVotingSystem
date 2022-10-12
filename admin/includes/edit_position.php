<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['edit_position'])){
			$position_name = ucfirst($_POST['position_name']);
			$pos_id = $_POST['pos_id'];   
			$priority = $_POST['priority'];   
			$sql = "UPDATE positions SET position_name='$position_name', priority='$priority' WHERE id='$pos_id'";  
			if($conn->query($sql)){  
				echo"<script type='text/javascript'>alert('Position updated successfully');window.location='../positions.php';</script>";	
			}
			else{
				echo"<script type='text/javascript'>alert('Error updating');window.location='../positions.php';</script>";
			}			
		}
		else{
			echo"warning";
			header('location: ../positions.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>