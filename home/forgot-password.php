<?php require './includes/connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../sources/bootstrap-4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="./../sources/fontawesome-free-5.15.3-web/css/all.min.css">
	<script src="../sources/jquery-3.6.0/jquery-3.6.0.min.js"></script>
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
	<ul>
		<li><a href="./index.php"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;Login</a></li>
	</ul>
</nav>
<div class="container">
	<div class="box">
		<form method="POST" action="./includes/password_reset.php">
			<h3>Reset Password</h3>
			<div class="form-group">
				<label for="firstName">Enter your first name</label>
				<input type="text" class="" id="firstName" name="firstName" pattern="[a-zA-Z]+" required>
			</div>
			<div class="form-group">
				<label for="lastName">Enter your last name</label>
				<input type="text" class="" id="lastName" name="lastName" pattern="[a-zA-Z]+" required>
			</div>
			<div class="form-group">
				<label for="regNo">Enter your Registration Number</label>
				<input type="text" class="" id="regNo" name="regNo" required>
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
nav {
	z-index: 9;
	position: fixed;
	background: black;
	height: 60px;
	top: 0;
	width: 100%;
	padding-right: 20px;
	padding-left: 10px;
}

nav .logo {
    float: left;
    color: white;
    font-size: 25px;
    font-weight: 700;
    margin-top: 10px;
    margin-left: 20px;
}

nav ul {
    float: right;
    position: relative;
    margin-top: 20px;
}

nav ul li {
    display: inline-block;
    padding-right: 10px;
}

nav ul li a {
    color: white !important;
    text-decoration: none !important;
    font-size: 15px;
    font-weight: bolder;
    padding: 8px 15px;
}

nav ul li a:hover {
    border-radius: 5px;
    box-shadow: 0 1px 20px #007bff, 0 1px 20px #007bff;
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
		padding-right:2px ;
		padding-left: 5px;
	}
	nav .logo {
		font-size: 22px;
		font-weight: 700;
		margin-top: 15px;
		margin-left: 0px;
		width: 70%;
		font-size: 22px;
		white-space: nowrap;
		overflow: hidden;
	}
	nav .logo:hover {
		overflow: scroll;
	}
	nav ul{
		margin-left: 0px;
		padding-left:0px;
	}
	nav ul li {
		padding-right: 0px;
	}
	nav ul li a {
		font-size: 14px;
		font-weight: bolder;
		padding: 5px 5px;
	}
	.container{
		margin-left:0px;
		margin-right:0px;
		margin-top:20px;
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

<script>
	$('.icon').click(function(){
		$('span').toggleClass("cancel");
	});
</script>
</body>
</html>