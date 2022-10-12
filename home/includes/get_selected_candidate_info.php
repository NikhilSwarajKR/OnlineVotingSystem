<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		$data=array();
		if(isset($_POST['pos_ids']) && isset($_POST['can_ids'])){
			$pos_ids=$_POST['pos_ids'];
			$can_ids=$_POST['can_ids'];
			if(is_array($pos_ids) && is_array($can_ids)){
				if(count($pos_ids)== count($can_ids)){
					for($i=0;$i<count($pos_ids);$i++){
						$get_query="SELECT position_name,position_id,candidate_id,firstname,lastname FROM positions LEFT JOIN candidates ON positions.id=candidates.position_id WHERE id='$pos_ids[$i]' AND candidate_id='$can_ids[$i]'";
						$get_result=$conn->query($get_query);
						$row=$get_result->fetch_assoc();
						array_push($data,$row);
					}
				}
			}
		}
		echo json_encode($data);
	}
	else{
		header('Location: ./home.php');
	}
?>



