<?php require './connection.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <title></title>
    <head>
        <link rel="stylesheet" href="../../sources/bootstrap-4.6.0/css/bootstrap.min.css">
    </head>
    <body>
	<nav>
         <div class="logo">
            <?php
            $query = "SELECT title FROM election_title WHERE 1";
            $result = $conn->query($query);
        $row=$result->fetch_assoc();
            echo "<p>".$row['title']."</p>";
   ?>
</div>
</nav>
        <div class="container">
		<div class="box">
			<form method="POST" action="./admin_reset.php">
				<h3>Administrator</h3>
                <div class="form-group">
					<label for="firstName">Enter your first name</label>
					<input type="text" class="" id="firstName" name="firstName" pattern="[a-zA-Z]+" required>
				</div>
                <div class="form-group">
					<label for="lastName">Enter your last name</label>
					<input type="text" class="" id="lastName" name="lastName" pattern="[a-zA-Z]+" required>
				</div>
				<div class="form-group">
					<label for="regNo">Enter your Username</label>
					<input type="text" class="" id="userName" name="userName" pattern="[a-z_.@0-9]+" required>
				</div>
				<div class="form-group">
					<label for="emailID">Enter your Email-ID</label>
					<input type="email" class="" id="emailID" name="emailID" required>
				</div>
				<button type="submit" class="btn btn-success submit" name="reset-password">Reset</button>
			</form>
		</div>
    </div>
<style>
	body{
		margin:0px;
		padding:0px;
		background-color:whitesmoke;
	}
	nav{
		z-index: 9;
		position: fixed;
		background: black;
		padding-top: 20px;
		width: 100%;
		top: 0;
		height: 60px;
		margin-right: 20px;
		}
	.logo{
		margin-top: -10px;
		color: #fff;
		padding-left: 30px;
		font-size: 25px;
		font-weight: 700;
		display: inline-block;
	}
	.container{
		margin-left:30%;
		margin-right:30%;
		margin-top:50px;
		padding:20px;
		width: 35%;
	}
	.box{
		width: 100%;
		background-color: white;
		border-radius:5px;
		padding:20px;
		display: flex;
		justify-content: center;
	}
	.box h3{
		text-align: center;
		margin-top:10px;
		margin-bottom: 10px;
	}
	.box label{
		float: left;
		font-style: italic;
		margin-top: 20px;
		font-weight: 500;
	}
	.box input
	{
		border: none;
		border-bottom: 1px solid #000;
		background: transparent;
		outline: none;width: 100%;
		height: 20px;
		font-size: 16px;
	}
	.submit{
		display: inline-block;
		width: 100%;
		margin-bottom: 5px;
		border-radius: 20px;
		margin-top: 20px;color: white;font-size:20px;
	}
	
	@media only screen and (max-width:800px){
		nav{
			padding-left:10px;
			padding-top:20px;
		}
		.logo{
			padding-left: 10px;
			font-size: 22px;
			font-weight: 700;
			width: 95%;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.logo:hover {
			overflow: scroll;
		}
		.container{
			margin-left:0px;
			margin-right:0px;
			margin-top:100px;
			padding:20px;
			width: 100%;
		}
		.box{
			background-color: white;
			padding:10px;	
			width: 100%;
			align-content: center;
		}
		.box h3{
			font-size:24px;
		}
    }
	</style>
    
</body>
</html>