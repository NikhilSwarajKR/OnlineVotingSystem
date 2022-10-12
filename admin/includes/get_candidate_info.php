<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['pos_id']) && isset($_POST['can_id'])){
			$pos_id=$_POST['pos_id'];
			$can_id = $_POST['can_id'];
			$sql = "SELECT * FROM candidates WHERE position_id='$pos_id' AND candidate_id = '$can_id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			echo json_encode($row);
		}
	}
?>