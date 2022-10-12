<?php
    require './includes/connection.php'; 
	if(isset($_POST['submit'])){
		if(empty($_POST['reg-email'])|| empty($_POST['password'])){
			echo"<script type='text/javascript'>alert('Please enter your login credentials!!');window.location='./index.php';</script>";
		    exit();
		}
		else{
			$reg_email=strtolower(trim($_POST['reg-email']));
			$password=$_POST['password'];
			$query="SELECT reg_no,voter_id,password FROM voters WHERE reg_no='$reg_email' OR email_id='$reg_email'";
			$result=$conn->query($query);	
			$count=$result->num_rows;
			if($count==1){
				$row=$result->fetch_assoc();
				if(password_verify($password,$row['password'])){
					session_start();
					$_SESSION['reg-no']=$row['reg_no'];
					$_SESSION['voter-id']=$row['voter_id'];
					header('Location: ./votepage.php');
				}	
				else{
					echo"<script type='text/javascript'>alert('Incorrect Password!!!!');window.location='./index.php';</script>";
					exit();
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Please Check Your Credentials!!');window.location='./index.php';</script>";
				exit();
			}
		}
	} 
	else{
		header('Location: ./home.php');
		exit();
	}
?>