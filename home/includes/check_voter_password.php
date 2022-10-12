<?php 
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		if(isset($_POST['reg_no'])&& isset($_POST['id'])){
			$s_reg_no=$_SESSION['reg-no'];
			$s_voter_id=$_SESSION['voter-id'];
			$reg_no = $_POST['reg_no'];
			$id = $_POST['id'];
			$password= $_POST['old_password'];
			if($s_reg_no==$reg_no && $s_voter_id==$id){
				$sql = "SELECT * FROM voters WHERE reg_no = '$reg_no' AND voter_id='$id'";
				$query = $conn->query($sql);
				$row = $query->fetch_assoc();
				if(password_verify($password,$row['password'])){
					echo"success";
				}
				else{
					echo"warning";
				}
			}
		}
	}
	else{
		header('Location: ./home.php');
	}
?>