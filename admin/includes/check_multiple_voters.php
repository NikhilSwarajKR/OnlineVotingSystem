<?php
	require './connection.php';
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(isset($_POST['emailData']) && isset($_POST['regData'])){
			$returnData=array();
			$emailData=$_POST['emailData'];
			$regData=$_POST['regData'];
			if(is_array($emailData) && is_array($regData)){
				if(count($emailData)== count($regData)){
					for($i=0;$i<count($emailData);$i++){
						$get_query="SELECT * FROM voters WHERE email_id='$emailData[$i]' OR reg_no='$regData[$i]'";
						$get_result=$conn->query($get_query);
						$count=$get_result->num_rows;
						if($count>0){
							array_push($returnData,$regData[$i]);
						}
					}
				}
			}
		echo json_encode($returnData);
		}
	}
?>