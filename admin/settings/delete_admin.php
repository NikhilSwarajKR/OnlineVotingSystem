<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['delete-admin'])){
			$adminID= $_POST['adminID'];
			$userName= $_POST['userName'];
			$password=$_POST['password-to-continue'];
			$cquery="SELECT * FROM admin";
			$cresult=$conn->query($cquery);
			$count=$cresult->num_rows;
			if($count==1){
				echo"<script type='text/javascript'>alert('Account cannot be deleted.');window.location.href='../admin.php';</script>";
			}
			else{
				$sessionAdminID=$_SESSION['admin-id'];
				$sessionUserName=$_SESSION['admin-username'];
				$getQuery="SELECT password FROM admin WHERE admin_id='$sessionAdminID' AND username='$sessionUserName'";
				$getResult=$conn->query($getQuery);
				$getRow=$getResult->fetch_assoc();
				if(password_verify($password,$getRow['password'])){
					$query = "DELETE FROM admin WHERE admin_id= '$adminID' AND username='$userName'";
					if($conn->query($query)){
						echo"<script type='text/javascript'>alert('Admin deleted Successfully.');window.location.href='../admin.php';</script>";
					}
					else{
						echo"<script type='text/javascript'>alert('Error while deleting the admin');window.location.href='../admin.php';</script>";
					}
				}
				else{
					echo"<script type='text/javascript'>alert('Incorrect password');window.location.href='../admin.php';</script>";
				}
				
			}	
		}
		else if(isset($_POST['delete-self'])){
			if($_POST['adminID']==$_SESSION['admin-id'] && $_POST['userName']==$_SESSION['admin-username']){
				$password=$_POST['password-to-continue'];
				$sessionAdminID=$_SESSION['admin-id'];
				$sessionUserName=$_SESSION['admin-username'];
				$cquery="SELECT * FROM admin";
				$cresult=$conn->query($cquery);
				$count=$cresult->num_rows;
				if($count==1){
					echo"<script type='text/javascript'>alert('Account cannot be deleted.');window.location.href='../admin.php';</script>";
					exit();
				}
				else{
					$getQuery="SELECT password FROM admin WHERE admin_id='$sessionAdminID' AND username='$sessionUserName'";
					$getResult=$conn->query($getQuery);
					$getRow=$getResult->fetch_assoc();
					if(password_verify($password,$getRow['password'])){
						$query = "DELETE FROM admin WHERE admin_id= '$sessionAdminID' AND username='$sessionUserName'";
						if($conn->query($query)){
							session_destroy();
							echo"<script type='text/javascript'>alert(' Your Account has been deleted successfully');window.location.href='../admin.php';</script>";
						}
						else{
							echo"<script type='text/javascript'>alert('Error while deleting the account');window.location.href='../admin.php';</script>";
						}
					}
					else{
						echo"<script type='text/javascript'>alert('Incorrect password');window.location.href='../admin.php';</script>";
					}
					
				}	
			}
			else{
				echo"<script type='text/javascript'>alert('Error while deleting the admin. Re-login and try again');window.location.href='../admin.php';</script>";
			}
		}
		else{
			header('location: ../index.php');
		}
	}
	else{
		header('Location: ../index.php');
	}	
?>