<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		$data=array();
		$sql = "SELECT id,position_name FROM positions ORDER BY priority ASC";
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$sql = "SELECT candidate_id,firstname,lastname,photo FROM candidates WHERE position_id = '".$row['id']."'";
			$cquery = $conn->query($sql);
			while($c_row = $cquery->fetch_assoc()){
				$data[]= $row+$c_row;
			}
		}
	echo json_encode($data);
	}
	else{
		header('Location: ../index.php');
	}
?>