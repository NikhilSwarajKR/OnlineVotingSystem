<?php
$server_name="localhost";
$root_username="root";
$root_password="";
$database_name="voting_system";
$conn=new mysqli($server_name,$root_username,$root_password,$database_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
