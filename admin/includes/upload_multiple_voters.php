<?php
	require './connection.php';
	require './mail_sender.php';
	$returnData=array();
	session_start();
	if(isset($_SESSION['admin-username'])){
		if(!empty($_POST['classID'])){
			$classID=$_POST['classID'];
			$firstName=$_POST['firstName'];
			$lastName=$_POST['lastName'];
			$regData=$_POST['regData'];
			$emailData=$_POST['emailData'];
			$cc_query="SELECT * FROM classes WHERE id='$classID'";
			$cc_result=$conn->query($cc_query);
			$cc_rows=$cc_result->num_rows;
			if($cc_rows==1){
				if(is_array($emailData) && is_array($regData)){
					if(count($emailData)== count($regData)){
						for($i=0;$i<count($emailData);$i++){
							if (filter_var($emailData[$i], FILTER_VALIDATE_EMAIL)){
								$query="SELECT * FROM voters WHERE reg_no='$regData[$i]' OR email_id='$emailData[$i]'";
								$result=$conn->query($query);
								$row_count=$result->num_rows;
								if($row_count>0){
									array_push($returnData,$regdata[$i]);
								} 
								else{
									$set = '@$&_123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$password = substr(str_shuffle($set), 0, 12);
									$password_hashed = password_hash($password, PASSWORD_DEFAULT);
									$query = "INSERT INTO voters (firstname, lastname, class_id, reg_no, email_id,password) VALUES ('$firstName[$i]', '$lastName[$i]','$classID', '$regData[$i]','$emailData[$i]', '$password_hashed')";
									if($conn->query($query)){
										$flag=send_voter_credentials($emailData[$i],$regData[$i],$password);
										sleep(1);
										if($flag){
										continue;}
									}
									else{
										array_push($returnData,$regdata[$i]);
									}
								}
							}
							else{
								array_push($returnData,$regdata[$i]);
							}
						}
						echo json_encode($returnData);
					}
					else{
						echo"error";
					}
				}
				else{
					echo"error";
				}
			}
		}
		else{
			echo"warning";
		}
	}
?>