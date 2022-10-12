<?php 
	require './includes/connection.php';
	session_start();
	if(!(isset($_SESSION['reg-no']))){
		header('Location: ./index.php');
	}
	else{
		$reg_no=$_SESSION['reg-no'];
		$voter_id=$_SESSION['voter-id'];
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../sources/fontawesome-free-5.15.3-web/css/all.min.css">
	<link rel="stylesheet" href="../sources/bootstrap-4.6.0/css/bootstrap.min.css">
	<script src="../sources/jquery-3.6.0/jquery-3.6.0.min.js"></script>
	<script src="../sources/bootstrap-4.6.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<nav class="my-nav">
	<div class="logo">
		<?php
			$query = "SELECT title FROM election_title WHERE 1";
			$result = $conn->query($query);
			$row=$result->fetch_assoc();
			echo "<p>".$row['title']."</p>";
		?>
	</div>
    <ul>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="./image_sources/voter-profile.png" class="rounded-circle dropdown"  width="35" height="35"></a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
				<img src="./image_sources/voter-profile.png" class="rounded-circle dropdown" width="60" height="60" >
				<?php  
					$query="SELECT * FROM voters WHERE reg_no='$reg_no' AND voter_id='$voter_id'";
					$result=$conn->query($query);
					while($row=$result->fetch_assoc()){
						echo "<p style='margin:0px;'>".$reg_no."</p>";
						echo "<p style=''>".$row['email_id']."</p>";
					}
				?>
				<a class="dropdown-item waves-effect waves-light" href="#" data-toggle="modal" data-target="#change_password_modal" style=" border-top: 1px solid #808080;"><i class="fa fa-key" aria-hidden="true" ></i>&nbsp; Change Password</a>
				<a class="dropdown-item waves-effect waves-light" href="./logout.php" name="logout"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>&nbsp; Logout</a>              
            </div>
          </li>       
    </ul>
</nav>

<div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="change_password_modal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" >Change Password</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<form id="change_password" action="./includes/change_voter_password.php" method="POST">
                <input type="hidden" class="voter-id" name="voter-id" value="<?php echo $voter_id;?>">
                <input type="hidden" class="voter-reg-no" name="reg-no" value="<?php echo $reg_no;?>">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Old Password</span>
					</div>
					<input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Your Old Password" onchange="checkOldPassword()" required>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">New Password</span>
					</div>
					<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter a New Password" onchange="checkBothPasswords()" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">New Password</span>
					</div>
					<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter the Password" onchange="checkBothPasswords()" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
				</div>	
				<p class="text-danger"> Password should have ,minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</p>
                <div id="new-password-check-div"></div>		
                <div id="old-password-check-div"></div>		
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='votepage.php'">Close</button>
			<button type="submit" form="change_password" class="btn btn-primary" name="change-password-submit" id="change-password-submit">Update</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="timer" hidden>
		<h6></h6>
	</div>
	<div id="reversetimer" hidden><p> -- -- -- -- </p></div>
    <div class="container text-center">

        

    </div>
        <div class="btn_class " hidden>
			<button class="btn btn-danger float-left prevBtn">Back</button>
			<button class="btn btn-success float-right nextBtn start_btn"> Next </button>
			<button type="button" class="btn btn-success submit"onclick="voteRegister()">Submit</button>
        </div>

<script>
            
	$(document).ready(function(){
		$.ajax({
			url:"./includes/check_voter_votes.php",
			method: "GET",
			success: function(data){
				$('.container').append('<nav hidden><div class="nav nav-tabs" id="nav-tab" role="tablist"><a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a></div></nav><form id="voting_form"><div class="tab-content" id="nav-tabContent"><div class="tab-pane  show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"></div></form>');
				if(data== "success"){
					$.ajax({
						type: 'GET',
						url: './includes/get_timing_info.php',
						dataType: 'JSON',
						success: function(response) {
							var startTime = new Date(response[0].start_time);
							var endTime = new Date(response[0].end_time);
							var today = new Date();
							if (today.getTime() >= startTime.getTime() && today.getTime() <= endTime.getTime()) {
								$('#reversetimer').removeAttr('hidden');
								reverseCountDown(endTime);
								showVotingContent();
								$('.btn_class').removeAttr('hidden');
							}
							else if(startTime.getTime()<=today.getTime() && endTime.getTime()<=today.getTime()){
								$('#timer').removeAttr('hidden');
								$('#timer h6').html('Your voting session has already ended.');
								$('.btn_class').attr('hidden',true);
								$('.container').append('</div>');
								$('.container').html('');
							}
							else{
								if(startTime=="Invalid Date" || endTime=="Invalid Date"){
									$('#timer').removeAttr('hidden');
									$('#timer h6').html('Your voting session has already ended.');
								}
								else{
									$('#timer').removeAttr('hidden');
									$('#timer h6').html('Your voting session is between '+startTime+' and '+endTime+'.');
									$('.btn_class').attr('hidden',true);
									$('.container').append('</div>');
									$('.container').html('');
									forwardCountDown(startTime);
								}
							}
						}
					});
				}
				else{
					$('.container').html('');
					$('.container').append("<h2>You have already voted for this election.</h2>");
					$('.nextBtn').hide();
				}   
			}
		});
	});
        
           
	var totalTabs;
	var currentTab = 1;
	showHideControls();
	$('.nextBtn').click(function() {
		if (currentTab > 1) {
			if ($('.tab-content >.active input[type=radio]').is(':checked')) {
				currentTab += 1;
				tabCount();
				showHideControls();
				var next_tab = $('.nav-tabs > .active').next('a');
				if (next_tab.length > 0) {
					document.documentElement.scrollTop=0;//for IE,Chrome,Firefox
					document.body.scrollTop=0; //for Safari
					next_tab.trigger('click');
				}
			} else {
				alert("Select a candidate");
			}
		} else {
			currentTab += 1;
			tabCount();
			showHideControls();
			var next_tab = $('.nav-tabs > .active').next('a');
			if (next_tab.length > 0) {
				document.documentElement.scrollTop=0;//for IE,Chrome,Firefox
				document.body.scrollTop=0; //for Safari
				next_tab.trigger('click');
			}
		}
	});

	$('.prevBtn').click(function() {
		currentTab -= 1;
		tabCount();
		showHideControls();
		var prev_tab = $('.nav-tabs > .active').prev('a');
		if (prev_tab.length > 0) {
			document.documentElement.scrollTop=0;//for IE,Chrome,Firefox
			document.body.scrollTop=0; //for Safari
			prev_tab.trigger('click');
		}
	});

	
	function tabCount() {
		totalTabs = $('.nav-tabs a').length;
	}

	function showHideControls() {
		if (currentTab == 1) {
			$('.prevBtn').hide();
			$('.nextBtn').html('Start Voting');
			$('.nextBtn').removeClass('float-right');
			$('.nextBtn').addClass('start_btn');
			$('.submit').hide();
		} else if (currentTab == totalTabs) {
			$('.nextBtn').hide();
			selectedCandidateData();
			$('.submit').show();
		} else {
			$('.nextBtn').html('Next');
			$('.prevBtn').show();
			$('.nextBtn').show();
			$('.nextBtn').addClass('float-right');
			$('.nextBtn').removeClass('start_btn');
			$('.submit').hide();

		}
	}
	function showVotingContent() {
		$.ajax({
			url: "./includes/get_candidates_data.php",
			method: "GET",
			success: function(data) {
				data = $.parseJSON(data);
				var pos_id = [],pos_name = [];
				for (var i in data) {
					pos_id.push(data[i].id);
					pos_name.push(data[i].position_name);
				}
				var pos_id = Array.from(new Set(pos_id));
				var pos_name = Array.from(new Set(pos_name));
				for (var i in pos_id) {
					var posName=pos_name[i].trim().split(" ").join("");
					$('.nav-tabs').append('<a class="nav-link" data-toggle="tab" href="#' + posName + '" role="tab" aria-selected="true">' + pos_name[i] + '</a>');
					var html = '<div class="tab-pane " id=' + posName + ' role="tabpanel" ><h1>' + pos_name[i] + ' Post</h1>';
					for (var j in data) {
						if (pos_id[i] == data[j].id) {
							var image, name;
							if (data[j].photo == "") {
								image = "profile.jpg";
							} else {
								image = data[j].photo;
							}
							name = data[j].firstname + " " + data[j].lastname;
							html = html + '<div class="card"><div class="card-body"><img src="../images/' + image + '"  style="border-radius:5px;"><div class="form-check form-check-inline"><input type="radio" class="form-check-input" id='+data[j].candidate_id+ name+' name=' + pos_id[i] + ' value=' + data[j].candidate_id + '><label class="form-check-label" for='+data[j].candidate_id+ name+'>&nbsp;'+ name +'</label></div></div></div>';
						}
					}
					html = html + '</div>';
					$('.tab-content').append(html);
				}
				$('.nav-tabs').append('<a class="nav-link" data-toggle="tab" href="#submit-tab" role="tab" aria-selected="true">Submit</a>');
				$('.tab-content').append('<div class="tab-pane display_data" id="submit-tab" role="tabpanel" aria-labelledby="profile-tab"></div>');
				
			},
			error: function(data) {
				console.log(data);
			}
		});		
	}
	
	function selectedCandidateData() {
		var p_array = [];
		var c_array = [];
		$('#voting_form input[type=radio]:checked').each(function() {
			var position_id = $(this).attr('name');
			var candidate_id = $(this).val();
			p_array.push(position_id);
			c_array.push(candidate_id);
			
		});
		$.ajax({
			url:"./includes/get_selected_candidate_info.php",
			method: "POST",
			data: {pos_ids:p_array,
				can_ids:c_array},
			success: function(data) {
				var data = $.parseJSON(data);
				$('.display_data').html('');
				$('.display_data').append('<h3> SELECTED CANDIDATES</h3>');
				for(var i=0;i<data.length;i++){
					$(".display_data").append('<div class="row"><h5  class="col">'+data[i].position_name+'</h5><p>:</p><span class="col" > '+data[i].firstname+' '+data[i].lastname+'</span></div>');
				}
			}
		});
	}
      
	function voteRegister(){
		$.ajax({
			url:"./includes/check_voter_votes.php",
			method: "GET",
			success: function(data){
				if(data== "success"){
					var p_array = [];
					var c_array = [];
					$('#voting_form input[type=radio]:checked').each(function() {
						var position_id = $(this).attr('name');
						var candidate_id = $(this).val();
						p_array.push(position_id);
						c_array.push(candidate_id);
					});
					$.post('./includes/vote_register.php', {
							'position_ids': p_array,
							'candidate_ids': c_array, 
						},
						function(data) {
							if (data = "success") {
								$('.container').html('');
								$('.container').append('<h2>Your vote has been registered successfully.</h2>');
								$('.prevBtn').hide();
								$('.submit').hide();
								$('#reversetimer').hide();
							} else if (data = "error") {
								alert('Error Updating Votes');
							} else {
								alert('Warning');
							}
						}
					);
				}
				else{
					alert('Warning!!');
					window.location.reload();
				}
			}
		});
	}

	function checkOldPassword(){
		var id=$('.voter-id').val();
		var reg_no=$('.voter-reg-no').val();
		var old_password=$('#old_password').val();
		$.ajax({
			type: 'POST',
			data:{id:id,
				reg_no:reg_no,
				old_password:old_password
			},
			url: './includes/check_voter_password.php',
			success: function(response){
				if(response=="success"){
					$('#old-password-check-div').html('');
					$('#change-password-submit').attr('disabled',false);
				}
				else if(response=="warning"){
					$('#old-password-check-div').append('<div class="alert alert-danger" role="alert">Incorrect Old password</div>');
					$('#change-password-submit').attr('disabled',true);
				}
			}
		});
	}
			
	function checkBothPasswords(){
		var new_password=$('#new_password').val();
		var confirm_password=$('#confirm_password').val();
		if(confirm_password!=""){
			if(new_password==confirm_password){
				$('#change-password-submit').attr('disabled',false);
				$('#new-password-check-div').html('');
			}
			else{
				$('#change-password-submit').attr('disabled',true);
				$('#new-password-check-div').html('');
				$('#new-password-check-div').append('<div class="alert alert-danger" role="alert">Entered passwords do not match</div>');
			}
		}
	}
	
	function reverseCountDown(endTime){
		var dest=new Date(endTime).getTime();
		var x=setInterval(function(){
			var now=new Date().getTime();
			var diff = dest-now;
			if(diff<=0){
				window.location="./votepage.php";
			}
			else{
				var days = Math.floor(diff/(1000*60*60*24));
				var hours = String(Math.floor((diff%(1000*60*60*24))/(1000*60*60))).padStart(2,'0');
				var minutes = String(Math.floor((diff%(1000*60*60))/(1000*60))).padStart(2,'0');
				var seconds = String(Math.floor((diff%(1000*60))/1000)).padStart(2,'0');
				$('#reversetimer p').html(days+"d: "+hours+"hr: "+minutes+ "m: "+seconds+"s");
			}
		},1000);
	}
	function forwardCountDown(startTime){
		var dest=new Date(startTime).getTime();
		var x=setInterval(function(){
			var now=new Date().getTime();
			var diff = dest-now;
			if(diff<=0){
				window.location="./votepage.php";
			}
		},1000);
	}
</script>
<style>
	body {
		height: 100vh;
		width: 100vw;
		margin: 0px;
		padding: 0px;
		overflow-y: auto;
		overflow-x: hidden;
		background-color: whitesmoke !important;
	}
	.my-nav{
		z-index:9;
		top:0;
		position:fixed;
		background-color: black;
		height:60px;
		width:100%;
	}
	.my-nav .logo{
		float: left;
		color: white;
		padding-top: 10px;
		padding-left: 30px;
		font-size:25px;
		font-weight:700;
	}
	.dropdown-toggle {
		float: right;
  		margin-top: 5px;
		margin-right: 5px;
		color: white;
	}
	.dropdown-menu {
		margin-top: 10px !important;
		margin-right: 20px !important;
		width: 225px;
		text-align: center !important;
	}

	.dropdown-menu p {
		margin-bottom: 5px;
	}

	.dropdown-item {
		text-align: left !important;
	}

	.input-group-text{
		width: 125px;
	}

	#timer{
		margin-top:100px;
		padding: 10px;
		text-align:center;
	}
	#timer h6{
		font-size: 18px;
	}
	#reversetimer{
		margin-top:70px;
		margin-right: 35px;
		text-align: right;
	}
	#reversetimer p{
		font-style: italic;
		font-weight: 500;
	}
	.container{
		margin-top: 0px;
		padding: 10px;
		margin-bottom:50px;
		text-align: center;
	}
	.container h2{
		margin-top: 80px;
	}
	.container h1{
		text-transform: uppercase;
	}
	.card{
		width:40%;
		height: 50%;
		position: relative;
		float:left;
		margin-bottom:20px;
		margin-left: 75px;
		padding: 20px;
		padding-right: 0px;
	}
	.card-body{
		text-align: left;
		padding: 0px;
	}
	.card-body img{
		border: 1px solid black;
		width:150px;
		height:150px;
	}
	.form-check{
		display: inline-block;
		margin-left: 20px;
		border: 0px;
	}
	.form-check label{
		padding-top: 20px;
		padding-bottom: 20px;
		text-transform: uppercase;
	}
	.form-check input{
		transform: scale(1.5);
	}
	.row{
		margin-right: 0px;
		margin-left: 0px;
	}
	.col{
		margin:0px;
		padding-left: 0px;
		padding-right: 0px;
	}
	.display_data{
		text-align: center;
	}
	.display_data h3{
		margin-bottom: 30px;
	}
	.display_data h5{
		font-weight: 500;
		font-size:20px ;
	}
	.display_data p{
		margin-left: 0px;
	}
	.display_data span{
		font-size: 15px;
		font-weight: 600;
		text-transform: uppercase;
	}
	.start_btn{
	   display: inline-block;
	   margin-top: 100px;
	   width:30%;
    }
    .float-left{
	   margin-left:45%;
    }
    .float-right{
	   margin-right:45%;
    }
	.btn_class{
		float:left;
		width:100%;
		text-align: center;
		margin-bottom: 20px;
	}
	.submit{
		margin-right:42%;
	}
	@media only screen and (max-width:1024px){
		.my-nav .logo{
			float: left;
			color: white;
			padding-top: 10px;
			padding-left: 10px;
			width:70%;
			font-size:22px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.my-nav .logo:hover{
			overflow-x:scroll;
		} 
		.container{
			margin-top: 0px;
			padding: 10px;
			margin-bottom:50px;
			text-align: center;
		}
		.container h1{
			font-size: 25px;
			margin-bottom:20px ;
		}
		.card{
			width:100%;
			margin-bottom:20px;
			margin-left: 0px;
		}
		.card-body img{
			width:160px;
			height:170px;
		}
		.form-check{
			margin-left:5%;
		}
		.form-check label{
			padding-top: 5px;
			padding-bottom: 5px;
			font-size:16px;
		}
		.start_btn{
			width:50%;
		}	
		.float-left{
			margin-left:25%;
		}
		.float-right{
			margin-right:25%;
		}	
		.submit{
			margin-right:25%;
		}
	}
</style>
</body>
</html>