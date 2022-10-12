<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['pos_id'])){
			$pos_id=$_POST['pos_id'];
			$sql = "SELECT * FROM positions WHERE id='$pos_id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			echo json_encode($row);
		}
	}
?>