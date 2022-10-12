<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['password-to-continue']) && isset($_POST['confirm-submit'])){
			$username=$_SESSION['admin-username'];
			$admin_id=$_SESSION['admin-id'];
			$password=$_POST['password-to-continue'];
			$cquery="SELECT password FROM admin WHERE username='$username' AND admin_id='$admin_id'";
			$cresult=$conn->query($cquery);
			$crow=$cresult->fetch_assoc();
			if(password_verify($password,$crow['password'])){
				$iquery="SELECT photo FROM candidates WHERE 1";
				$iresult=$conn->query($iquery);
				while($row=$iresult->fetch_assoc()){
					if(!empty($row['photo'])){
						if(!unlink('../../images/'.$row['photo'])){
							echo" Not a success";
						}
					}
				}
				$c_query = "DELETE FROM candidates WHERE 1";
				$cv_query = "DELETE FROM candidate_votes WHERE 1";
				$c_result=$conn->query($c_query);
				$cv_result=$conn->query($cv_query);
				if($c_result && $cv_result){
					echo"<script type='text/javascript'>alert('All candidates deleted successfully');window.location.href='../ballot.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while deleting the candidates.');window.location.href='../ballot.php';</script>";
				}	
			}
			else{
				echo"<script type='text/javascript'>alert('Your password does not match');window.location.href='../ballot.php';</script>";
			}
		}
		else{
			header('Location: ../ballot.php');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>