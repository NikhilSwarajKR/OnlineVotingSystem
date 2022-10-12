<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['add_position'])){
			$position_name = ucfirst($_POST['position_name']);
			$priority = $_POST['priority'];
			$check_query= "SELECT * FROM positions WHERE position_name='$position_name' OR priority='$priority' ";
			$result = $conn->query($check_query);
			if($result->num_rows>0){
				echo"<script type='text/javascript'>alert('Priority already exists');window.location='../positions.php';</script>";
			}
			else{
				$sql = "INSERT INTO positions (position_name, priority) VALUES ('$position_name', '$priority')";
				if($conn->query($sql)){
					echo"<script type='text/javascript'>alert('Added successfully');window.location='../positions.php';</script>";
					exit();
				}
			}
		}
		else{
			header('location: ../positions.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>