<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['title-submit'])){
			$title=$_POST['election-title'];
			$query = "UPDATE election_title SET title='$title' WHERE 1";
			$result = $conn->query($query);
			if($result){
				echo"<script type='text/javascript'>alert('Election title is updated');window.location='../ballot.php';</script>";		
			}
			else{
				echo"<script type='text/javascript'>alert('Error!! updating election title');window.location='../ballot.php';</script>";		
			}
		}
		else{
			echo "warning";
			header('location: ../ballot.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>