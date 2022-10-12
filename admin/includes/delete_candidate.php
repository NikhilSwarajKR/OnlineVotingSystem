<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['delete_candidate'])){
			$pos_id = $_POST['pos_id'];
			$can_id = $_POST['can_id'];
			$del_query="SELECT * FROM candidates WHERE position_id='$pos_id' AND candidate_id='$can_id'";
			$del_result=$conn->query($del_query);
			while($del_row=$del_result->fetch_assoc()){
				if(!empty($del_row['photo'])){
					if(!unlink('../../images/'.$del_row['photo'])){
						echo"error";
					}
				}
				$c_query = "DELETE FROM candidates WHERE position_id = '$pos_id' AND candidate_id='$can_id'";
				$cv_query = "DELETE FROM candidate_votes WHERE position_id = '$pos_id' AND candidate_id='$can_id'";
				$c_result=$conn->query($c_query);
				$cv_result=$conn->query($cv_query);
				if($c_result && $cv_result){
					echo"<script type='text/javascript'>alert('Candidate deleted successfully.');window.location.href='../candidates.php';</script>";
				}
				else{
					echo"<script type='text/javascript'>alert('Error while deleting the candidate.');window.location.href='../candidates.php';</script>";
				}
			}
		}
		else{
			echo "error";
			header('location: ../candidates.php');
		}
	}
	else{
		header('Location: ../index.php');
	}	
?>