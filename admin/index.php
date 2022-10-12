 <?php require './includes/connection.php'?>
<!DOCTYPE html>
<html>
<head>
  	<title>Admin Login Page</title>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../sources/bootstrap-4.6.0/css/bootstrap.css">
	<link rel="stylesheet" href="./../sources/fontawesome-free-5.15.3-web/css/all.min.css">
</head>
<body>
<nav>
	<div class="logo">
		<?php
			$query = "SELECT title FROM election_title WHERE 1";
			$result = $conn->query($query);
			$row=$result->fetch_assoc();
			echo "<p>".$row['title']."</p>";
			$conn->close();
   		?>
	</div>
</nav>
<div class="login">
	<div class="login-box">
	<img src="./image_sources/profile.png" >
		<form method="POST" action="./login.php">
			<h3>Administrator</h3>
			<div class="form-group">
				<label for="usrname-email">Username / E-mail ID</label>
				<input type="text" class="" id="usrname-email" name="usrname-email" placeholder="Enter Your username or E-mail ID" required>
			</div>
			<div class="form-group">
				<label for="passwrd">Password</label>
				<input type="password" class="" id="passwrd" name="password" placeholder="Enter your password" required>
			</div>
			<button type="submit" class="btn btn-primary submit" name="login"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
			<a href="./settings/forgot.php" ><b>Forgot Password?</b></a>
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
	.login{
		margin-left:30%;
		margin-right:30%;
		margin-top:100px;
		padding:30px;
		width: 35%;
	}
	.login-box{
		width: 100%;
		background-color: white;
		border-radius:5px;
		padding:20px;
		display: flex;
		justify-content: center;
	}
	.login-box h3{
		text-align: center;
		margin-top:40px;
		margin-bottom: 20px;
	}
	.login-box label{
		float: left;
		font-style: italic;
		margin-top: 20px;
		font-weight: 500;
	}
	.login-box input
	{
		border: none;
		border-bottom: 1px solid #000;
		background: transparent;
		outline: none;width: 100%;
		height: 40px;
		font-size: 16px;
	}
	.login-box img{
		width:80px;
		height: 80px;
		margin-top:-50px;
		position: absolute;
	}
	.submit{
		display: inline-block;
		width: 100%;
		margin-bottom: 30px;
		border-radius: 20px;
		margin-top: 20px;color: white;font-size:20px;
	}
	.login-box a{
    text-decoration: none;
    color: black;
    font-style: italic;
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
		.login{
			margin-left:0px;
			margin-right:0px;
			margin-top:100px;
			padding:20px;
			width: 100%;
		}
		.login-box{
			background-color: white;
			padding:10px;	
			width: 100%;
			align-content: center;
		}
		.login-box h3{
			font-size:24px;
		}
	}
</style>
</body>
</html>