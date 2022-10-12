<?php
	require "./connection.php";
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST["add_candidate"])){
			$first_name=ucfirst(trim(strtolower($_POST['first_name'])));
			$last_name=ucfirst(trim(strtolower($_POST['last_name'])));
			$photo=$_FILES['photo']['name'];
			$pos_id=$_POST['position_id'];	
			$description=$_POST['description'];	
			if(!empty($photo)){
				$random=rand();
				$ext=strtolower(substr(strrchr($photo,'.'),1));
				$photo_new_name=$random.$first_name.$last_name.$pos_id.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$photo_new_name);
				$photo=$photo_new_name;			
			}
			$insert_candidate_query="INSERT INTO candidates(position_id, firstname, lastname, photo, description) VALUES ('$pos_id','$first_name','$last_name','$photo','$description')";
			if($conn->query($insert_candidate_query)){
					$can_id=$conn->insert_id;
					$cv_insert_query="INSERT INTO candidate_votes(position_id, candidate_id, c_votes) VALUES ('$pos_id','$can_id','0')";
					if($conn->query($cv_insert_query)){
					echo"<script type='text/javascript'>alert('Candidate added successfully');window.location.href='../candidates.php';</script>";
					}
			}	
		}
		else{
			echo"<script type='text/javascript'>alert('Error Uploading Data!');window.location.href='../candidates.php';</script>";
		}
	}
	else{
		header('Location: ../index.php');
	}
?>