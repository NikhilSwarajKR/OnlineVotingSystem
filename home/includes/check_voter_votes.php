<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		$reg_no=$_SESSION['reg-no'];
		$query = "SELECT * FROM voters_voted WHERE reg_no = '$reg_no'";
		$result = $conn->query($query);
		$row_count=$result->num_rows;
		if($row_count>0){
			echo "warning";
		}
		else{
			echo "success";
		}
	}
	else{
		header('Location: ./home.php');
	}	
?>