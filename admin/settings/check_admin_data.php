<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		$data="error";
		if(isset($_POST['email_id']) && isset($_POST['username'])){
			$admin_id=$_SESSION['admin-id'];
			$emailid=$_POST['email_id'];
			$username=$_POST['username'];
			$cquery="SELECT * FROM admin WHERE username='$username' OR email_id='$emailid'";
			$cresult=$conn->query($cquery);
			$count=$cresult->num_rows;
			if($count>0){
				while($crow=$cresult->fetch_assoc()){
					if($crow['admin_id']==$admin_id){
						$data="success";
					}
					else{
						$data="warning";
					}
				}
			}
			else{
				$data="success";
			}
			echo $data;
		}
		else if(isset($_POST['new_email_id']) && isset($_POST['new_username'])){
			$emailid=$_POST['new_email_id'];
			$username=$_POST['new_username'];
			$cquery="SELECT * FROM admin WHERE username='$username' OR email_id='$emailid'";
			$cresult=$conn->query($cquery);
			$count=$cresult->num_rows;
			if($count>0){
				$data="warning";
			}
			else{
				$data="success";
			}
			echo $data;			
		}
		else{
			echo $data;
		}
	}
?>