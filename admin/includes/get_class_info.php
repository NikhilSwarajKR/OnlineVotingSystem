<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$uniq_id = $_POST['uniq_id'];
			$sql = "SELECT * FROM classes LEFT JOIN timings ON classes.id=timings.class_id WHERE classes.id= '$id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			echo json_encode($row);
		}
	}
?>