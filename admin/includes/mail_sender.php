<?php
function send_voter_credentials($email_id,$voter_id,$password) {
	$to_mail=$email_id;
	$message="Dear Student your voter credentials are as mentioned below."."\n\nYour Voter id:  ".$voter_id."\nYour Password:  ".$password."\n\nThank You";
	$subject="Voter Credentials for upcoming student council elections";
	$headers="From: voters.credentials@gmail.com";
	if(mail($to_mail,$subject,$message,$headers)){
		return true;
	}
	else{
		return false;
	}
}
?>