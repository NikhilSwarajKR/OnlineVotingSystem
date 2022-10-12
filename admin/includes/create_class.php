<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['add-class-submit'])){
			if(!empty($_POST['class-name'])){
				$class_name=strtoupper($_POST['class-name']);
				$c_query="INSERT INTO classes(class_name) VALUES ('$class_name')";
				$c_result=$conn->query($c_query);
				if($c_result){
					$class_id=$conn->insert_id;
					$t_query="INSERT INTO timings(class_id) VALUES ('$class_id')";
					$t_result=$conn->query($t_query);
					if($t_result){
						echo"<script type='text/javascript'>alert('Created a class successfully.');window.location.href='../ballot.php';</script>";
					}
				}
				else{
					echo"<script type='text/javascript'>alert('Error while creating a class');window.location.href='../ballot.php';</script>";
				}
			}
			else{
				echo"<script type='text/javascript'>alert('Empty Fields!!!!');window.location.href='../ballot.php';</script>";
			}
		}
		else{
			header('location: ../ballot.php');
		}
	}
	else{
		header('Location: ../index.php');
	}	
?>