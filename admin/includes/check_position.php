<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['pos_id'])){
			$pos_id=$_POST['pos_id'];
			$position_name=$_POST['position_name'];
			$priority=$_POST['priority'];
			$query="SELECT * FROM positions WHERE position_name='$position_name' OR priority='$priority'";
			$result=$conn->query($query);
			$row_count=$result->num_rows;
			if($row_count>0){
				while($row=$result->fetch_assoc()){
					if($pos_id==$row['id']){
						if($priority==$row['priority']){
							echo"success";
						}
						else if($position_name==$row['position_name']){
							echo"success";
						}
						else{
							echo"warning";
						}
					}
					else{
						echo"warning";
					}
				}
			} 
			else {
				echo"success";
			}
		}
		else{
			$position_name=$_POST['position_name'];
			$priority=$_POST['priority'];
			$query="SELECT * FROM positions WHERE position_name='$position_name' OR priority='$priority' ";
			$result=$conn->query($query);
			$row_count=$result->num_rows;
			if($row_count>0) {
				echo"warning";
			} 
			else {
				echo"success";
			}
		}
	}
	else{
		header('Location: ../index.php');
	}		
?>