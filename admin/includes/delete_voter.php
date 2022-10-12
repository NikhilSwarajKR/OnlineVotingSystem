<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['delete'])){
			$voter_id= $_POST['voter-id'];
			$reg_no= $_POST['reg_no'];
			$query = "DELETE FROM voters WHERE reg_no = '$reg_no' AND voter_id='$voter_id'";
			if($conn->query($query)){
				echo"<script type='text/javascript'>alert('Voter deleted Successfully.');window.location.href='../voters.php';</script>";
			}
			else{
				echo"<script type='text/javascript'>alert('Error while deleting the voter');window.location.href='../voters.php';</script>";
			}
		}
		else{
			echo "error";
			header('location: ../voters.php');
		}
	}
	else{
		header('Location: ../index.php');
	}	
?>