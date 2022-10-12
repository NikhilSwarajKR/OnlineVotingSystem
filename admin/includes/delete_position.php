<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['delete_position'])){
			$pos_id = $_POST['pos_id'];
			$pquery = "DELETE FROM positions WHERE id = '$pos_id'";
			$presult=$conn->query($pquery);
			if($presult){
				echo"<script type='text/javascript'>alert('Position deleted successfully');window.location.href='../positions.php';</script>";
			}
			else{
				echo"<script type='text/javascript'>alert('Error while deleting the position.');window.location.href='../positions.php';</script>";
			}	
		}
		else{
			echo "error";
			header('location: ../positions.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>