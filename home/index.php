<?php include './includes/nav_bar.php'; ?>
<div class="login">
    <div class="login-box">
    <img src="./image_sources/voter-profile.png">
      <form action="./login.php" method="POST">
      <h3>Voters Login</h3>
          <div class="form-group">
            <label>Register number / E-mail ID</label>
            <input type="text" name="reg-email" placeholder="Enter your Register number or E-mail ID">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your Password">
          </div>
          <button type="submit" class="btn btn-primary submit" name="submit"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
          <a href="./forgot-password.php"><b>Forgot Password?</b></a>    
      </form>
      </div>
</div>
 
<style>
  .login{
		margin-left:30%;
		margin-right:30%;
		margin-top:20px;
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
		.login{
			margin-left:0px;
			margin-right:0px;
			margin-top:60px;
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
<script>
$(document).ready(function(){
  $('nav ul li a').eq(3).addClass("active");
});
</script>
</body>
</html>
