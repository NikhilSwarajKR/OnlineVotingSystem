<?php
include './connection.php';
	$sql = "SELECT id,position_name FROM positions ORDER BY priority ASC";
	$query = $conn->query($sql);
	$data=array();
	while($row = $query->fetch_assoc()){
		$sql = "SELECT candidate_id,firstname,lastname,photo,description FROM candidates WHERE position_id = '".$row['id']."'";
		$cquery = $conn->query($sql);
		while($c_row = $cquery->fetch_assoc()){
			$data[]= $row+$c_row;
		}
	}
echo json_encode($data);
?>