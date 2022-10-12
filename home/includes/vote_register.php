<?php                                 
	require './connection.php';
	session_start();	
	if(isset($_SESSION['reg-no'])&& isset($_SESSION['voter-id'])){
		$position_ids=$_POST['position_ids'];
		$candidate_ids=$_POST['candidate_ids'];
		if(is_array($position_ids) && is_array($candidate_ids)){
			$reg_no=$_SESSION['reg-no'];
			$voter_id=$_SESSION['voter-id'];
			$counter=0;
			$query = "SELECT * FROM voters_voted WHERE reg_no = '$reg_no'";
			$result = $conn->query($query);
			$row_count=$result->num_rows;
			if($row_count>0){
				echo "warning";
			}
			else{
				if(count($position_ids)== count($candidate_ids)){	
					for($i=0;$i<count($position_ids);$i++){
						$check_query="SELECT * FROM candidate_votes WHERE position_id=$position_ids[$i] AND candidate_id=$candidate_ids[$i]";
						$check_result=$conn->query($check_query);
						$row_count=$check_result->num_rows;
						if($row_count==1){
							$counter++;
						}
					}
					if($counter==count($position_ids)){	
						$counter=0;
						for($i=0;$i<count($position_ids);$i++){
							$query="UPDATE candidate_votes SET c_votes=c_votes+1 WHERE position_id=$position_ids[$i] AND candidate_id=$candidate_ids[$i]"; 
							$result=$conn->query($query);
							if($result){
								$counter++;
							}
						}
						if($counter==count($position_ids)){
							$v_query="INSERT INTO voters_voted(`reg_no`) VALUES ('$reg_no')";
							$v_result=$conn->query($v_query);
							if($v_result){
								echo"success";
							}
						}
					}  
					else{
						echo"error";
					}
				} 
			}
				
		}
		else{
			echo"warning";
		}	
	}
	else{
		header('Location: ./home.php');
	}
?>