<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['admin_set_update'])){
			$admin_id=$_SESSION['admin-id'];
			$firstname=ucfirst(strtolower($_POST['first_name']));
			$lastname=ucfirst(strtolower($_POST['last_name']));
			$username=strtolower($_POST['username']);
			$emailid=strtolower($_POST['admin_email']);
			$cquery="SELECT * FROM admin WHERE username='$username' OR email_id='$emailid'";
			$cresult=$conn->query($cquery);
			$count=$cresult->num_rows;
			while($crow=$cresult->fetch_assoc()){
				if($crow['admin_id']==$admin_id){
					$count=0;
				}
				else{
					$count=$count;
				}
			}
			if($count==0){
				$query="SELECT * FROM admin WHERE admin_id='$admin_id'";
				$result=$conn->query($query);
				$row_count=$result->num_rows;
				if($row_count>0){
					$query2="UPDATE admin SET firstname='$firstname', lastname='$lastname', username='$username',email_id='$emailid' WHERE admin_id='$admin_id'";
					if($conn->query($query2)){
						$_SESSION['admin-username']=$username;
						echo"<script type='text/javascript'>alert('Profile updated successfully');window.location.href='../home.php';</script>";
					}
					else{
						echo"<script type='text/javascript'>alert('Connection Error');window.location.href='../home.php';</script>";
					}
				}
				else{
					echo"<script type='text/javascript'>alert('User Doesn't exist');window.location.href='../home.php';</script>";
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Username/Email is already exists');window.location.href='../home.php';</script>";
			}
		}
		else{
			header('Location: ../home.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>