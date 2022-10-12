<?php
	require('./connection.php');
	session_start();
	if(isset($_SESSION['admin-username'])){
		$sql = "SELECT id,position_name FROM positions ORDER BY priority ASC";
		$query = $conn->query($sql);
		$data=array();
		while($row = $query->fetch_assoc()){
			$sql = "SELECT candidate_id,firstname,lastname FROM candidates WHERE position_id = '".$row['id']."'";
			$cquery = $conn->query($sql);
			while($c_row = $cquery->fetch_assoc()){
				$sql = "SELECT c_votes FROM candidate_votes WHERE position_id='".$row['id']."' AND candidate_id = '".$c_row['candidate_id']."'";
				$vquery = $conn->query($sql);
				$v_row=$vquery->fetch_assoc();
				$data[]= $row+$c_row+$v_row;
			}
		}
		echo json_encode($data);
	}
?>