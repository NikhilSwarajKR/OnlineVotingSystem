<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		$reg_no=$_SESSION['reg-no'];
		$voter_id=$_SESSION['voter-id'];
		$data=array();
		$v_query="SELECT class_id FROM voters WHERE reg_no='$reg_no' AND voter_id='$voter_id'";
		$v_result=$conn->query($v_query);
		$v_row=$v_result->fetch_assoc();
		$t_query="SELECT * FROM classes LEFT JOIN timings ON classes.id=timings.class_id WHERE classes.id='".$v_row['class_id']."'";
		$t_result=$conn->query($t_query);
		$t_row=$t_result->fetch_assoc();
		array_push($data,$v_row+$t_row);
		echo json_encode($data);
	}
	else{
		header('Location: ./home.php');
	}
?>