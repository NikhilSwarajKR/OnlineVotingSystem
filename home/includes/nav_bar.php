<?php 
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en" >
   <head>
      <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
      <link rel="stylesheet" href="./styles/nav_bar.css">
      <link rel="stylesheet" href="./../sources/bootstrap-4.6.0/css/bootstrap.css">
      <link rel="stylesheet" href="./../sources/fontawesome-free-5.15.3-web/css/all.min.css">
      <script type="text/javascript" src="./../sources/jquery-3.6.0/jquery-3.6.0.min.js"></script>
      <script src="./../sources/bootstrap-4.6.0/js/bootstrap.min.js"></script>
   </head>
<body>
   <script>
      $('.icon').click(function(){
         $('span').toggleClass("cancel");
      });
   </script>
      
<nav class="sticky-top">
      <div class="logo">
         <?php
            $query = "SELECT title FROM election_title WHERE 1";
            $result = $conn->query($query);
            $row=$result->fetch_assoc();
            echo "<p>".$row['title']."</p>";
            $conn->close();
         ?>
      </div>
      <label for="btn" class="icon">
      <span class="fa fa-bars"></span>
      </label>
      <input type="checkbox" id="btn">
      <ul>
    <li><a href="./home.php"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    <li><a href="./about.php"><i class="fas fa-info-circle"></i>&nbsp;About</a></li>
    <li><a href="./display-candidates.php"><i class="fas fa-user-tie"></i>&nbsp;Candidates</a></li>
    <li><a href="./index.php"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a></li>
  </ul>
</nav>
