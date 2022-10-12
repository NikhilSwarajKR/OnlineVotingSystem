<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['edit_candidate'])){
			$pos_id = $_POST['pos_id'];   
			$can_id = $_POST['can_id'];   
			$firstname = ucfirst(trim(strtolower($_POST['first_name'])));  
			$lastname = ucfirst(trim(strtolower($_POST['last_name'])));  
			$new_pos_id = $_POST['position'];  
			$img_photo= $_FILES['photo']['name']; 
			$description = $_POST['description'];  
			$img_query="SELECT photo FROM candidates WHERE position_id='$pos_id' AND candidate_id='$can_id'";
			$img_result=$conn->query($img_query);
			$img_row=$img_result->fetch_assoc();
			if($img_photo==""){
				$photo=$img_row['photo'];
			} 
			else{
				if(!empty($img_row['photo'])){
					unlink('../../images/'.$img_row['photo']);
				}
				$random=rand();
				$ext=strtolower(substr(strrchr($img_photo,'.'),1));
				$photo_new_name=$random.$firstname.$lastname.$new_pos_id.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$photo_new_name);
				$photo=$photo_new_name;	
			}
			$c_query = "UPDATE candidates SET position_id='$new_pos_id',firstname='$firstname',lastname='$lastname',photo='$photo',description='$description' WHERE position_id='$pos_id' AND candidate_id='$can_id'";  
			$cv_query="UPDATE candidate_votes SET position_id='$new_pos_id' WHERE position_id='$pos_id' AND candidate_id='$can_id'";
			$c_result=$conn->query($c_query);
			$cv_result=$conn->query($cv_query);
			if($c_result && $cv_result){  
				echo"<script type='text/javascript'>alert('Candidate details updated successfully');window.location='../candidates.php';</script>";	
			}
			else{
				echo"<script type='text/javascript'>alert('Error updating candidate data');window.location='../candidates.php';</script>";
			}		
			
		}
		else{
			echo "error";
			header('location: ../candidates.php');
		}
	}
	else{
		header('location: ../index.php');
	}
?>