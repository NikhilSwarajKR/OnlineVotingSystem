<?php
	include 'connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['voter_id']) && isset($_POST['voter_reg_no'])){
			$data;
			$voter_id=$_POST['voter_id'];
			$voter_reg_no=$_POST['voter_reg_no'];
			$reg_no=$_POST['reg_no'];
			$email_id=$_POST['email_id'];
			if (filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$query="SELECT * FROM voters WHERE reg_no='$reg_no' OR email_id='$email_id' ";
				$result=$conn->query($query);
				$row_count=$result->num_rows;
				if($row_count>0){
					while($row=$result->fetch_assoc()){
						if($voter_id==$row['voter_id']){
							$data="success";
						}
						else{
							$data="danger";
						}
					}
				} 
				else {
					$data="success";
				}
			}
			else{ 
				$data="warning";
			}
			echo $data;
		}
		else{
			$reg_no=$_POST['reg_no'];
			$email_id=$_POST['email_id'];
			if (filter_var($email_id, FILTER_VALIDATE_EMAIL)){
				$query="SELECT * FROM voters WHERE reg_no='$reg_no' OR email_id='$email_id' ";
				$result=$conn->query($query);
				$row_count=$result->num_rows;
				if($row_count>0) {
					echo "danger";
				} 
				else {
					echo "success";
				}
			}
			else{ 
				echo"warning";
			}
		}
	}	
?>