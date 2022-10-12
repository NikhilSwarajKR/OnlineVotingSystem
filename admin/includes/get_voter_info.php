<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['reg_no'])&& isset($_POST['id'])){
			$reg_no = $_POST['reg_no'];
			$id = $_POST['id'];
			$sql = "SELECT * FROM voters WHERE reg_no = '$reg_no' AND voter_id='$id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			echo json_encode($row);
		}
	}
?>