<?php include './includes/nav_bar.php'; ?>

<div class="content">
  <h2><b>"WELCOME TO ONLINE VOTING SYSTEM"</b></h2>
  <p>Online Voting is a web-based voting system that will help you manage your elections easily and securely.</p><br>
  <a class="btn btn-primary" href="index.php"><b>Vote Now</b></a>
</div>

<div class="image">
  <img src="./image_sources/home_pic.png" height="550vh" width="">
</div>

<style>
  .content{
    width: 630px;
    text-align: center;
    padding:10px;
    float: right;
    border: none;
    margin-right: 38px;
    margin-top: 130px;
  }
  img{
    top:0px;
    border: 1px solid;
    border: none;
    margin-top: 8px;
    margin-left: 10px;
  }
  .content h2{
    font-size:28px;
  }
  .content p{
    padding:30px ;
    margin-left: 17px;
    font-size: 18px;
  }

  .content a{
	text-decoration:none;
    padding: 10px;
    border: none;
    width: 270px;
    color:white;
    font-size:18px;
    border-radius: 5px;
    background-color: #007bff;
    display: inline-block;
  }

  @media all and (max-width: 1024px) {
    .content{
      width: 100%;
      text-align: center;
      padding: 5px;
      border: none;
      margin-right: 0px;
      margin-top: 20px;
    }
    img{
      height: 50%;
      margin-top: 20px;
      width:100%;
    }
    .content h2{
      font-size:17px;
    }
    .content p{
      padding:20px ;
      margin-left: 17px;
      font-size: 15px;
      float: left;
    }
  }
</style>
<script>
$(document).ready(function(){
  $('nav ul li a').eq(0).addClass("active");
});
</script>
</script>
</body>
</html>
