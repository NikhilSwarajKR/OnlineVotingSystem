<?php
    require './includes/connection.php'; 
	if(isset($_POST['login'])){
		if(empty($_POST['usrname-email'])|| empty($_POST['password'])){
			echo"<script type='text/javascript'>alert('Please enter your login credentials!!');window.location='./index.php';</script>";
		    exit();
		}
		else{
			$username=strtolower(trim($_POST['usrname-email']));
			$password=$_POST['password'];
			$query="SELECT admin_id,username,password FROM admin WHERE username='$username' OR email_id='$username'";
			$result=$conn->query($query);	
			$count=$result->num_rows;
			if($count==1){
				$row=$result->fetch_assoc();
				if(password_verify($password,$row['password'])){
					session_start();
					$_SESSION['admin-username']=$row['username'];
					$_SESSION['admin-id']=$row['admin_id'];
					header('Location: ./home.php');
				}	
				else{
					echo"<script type='text/javascript'>";
					echo"alert('Incorrect Password!!!!');";
					echo"window.location='./index.php';";
					echo"</script>";
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
		header('Location: ./index.php');
		exit();
	}
?>