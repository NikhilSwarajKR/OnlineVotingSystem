<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item active"><a href="home.php"><i class="fas fa-tachometer-alt"></i>&nbsp;<span>Dashboard</span></a>
		</ol>
	</nav>
	  
	<div class="cards-body">
	<div class="card bg-aqua">
        <div class="card-body">
            <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
            ?>
	            <p>No. of Positions</p>
	            <div class="icon">
                    <i class="fa fa-tasks"></i>
                </div>
        </div>
        <div class="card-footer text-muted">
             <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
		
		<div class="card bg-green">
            <div class="card-body">
            <?php
                $sql = "SELECT * FROM candidates";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
            ?>
	            <p>No. of Candidates</p>
	            <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
		
		<div class="card bg-yellow">
            <div class="card-body ">
             <?php
                $sql = "SELECT * FROM voters";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
	            <p>Total Voters</p>
	            <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="card-footer text-muted ">
                <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
		
		<div class="card bg-red">
            <div class="card-body">
             <?php
                $sql = "SELECT * FROM voters_voted GROUP BY reg_no";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
	            <p>Voters voted</p>
	            <div class="icon">
                    <i class="fas fa-vote-yea"></i>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
	</div>
	<div class="box" id="mygraphs" hidden>

	</div>
</div>

<style>
.cards-body{
	margin-bottom:50px;
}
.card {
    width: 23%;
	height:150px;
	margin:10px;
	float: left;
	position: relative;
    padding-right: 5px;
}

.icon {
    transition: all .3s linear;
    position: absolute;
    top: -20px;
    right: 10px;
    font-size: 90px;
    color: rgba(0,0,0,0.15);
}
.card-footer{
	text-align:center;
}
.card-footer a{
	color:white; 
	text-decoration:none;
}
#mygraphs{
	margin-top: 200px;
}
canvas{
	width:60%;
	height:50%;
	margin:20px;
}

@media screen and (max-width: 780px) {
	.card {
		width: 90%;
		height:180px;
		margin-bottom:10px;
		float: left;
		position: relative;
		padding-right: 5px;
	}
	.icon {
		transition: all .3s linear;
		position: absolute;
		top: -10px;
		right: 10px;
		font-size: 100px;
		color: rgba(0,0,0,0.15);
	}
	#mygraphs{
		margin-top: 850px;
		width:100%;
		/* height: auto; */
	}
	canvas{
		width:90%;
		height:100%;
		margin:20px;
	}

}

</style>
<script>
     $(document).ready(function(){
		var graphs_Div=document.getElementById('mygraphs');
		$.ajax({
			url:"./includes/get_graph_info.php",
			method:"GET",
			success:function (data){
				data=$.parseJSON(data);
				var pos_id=[],pos_name=[];
				if(data.length==0){
					$('#mygraphs').prop('hidden',true);
				}
				else{
					$('#mygraphs').prop('hidden',false);
				}
				for(var i in data){
					pos_id.push(data[i].id);
					pos_name.push(data[i].position_name);
				}
				var pos_id=Array.from(new Set(pos_id));
				var pos_name=Array.from(new Set(pos_name));
				var dynamicColors = function(){
					color = "hsl(" + Math.random() * 360 + ", 100%, 70%)";
					return color;
				}
				for(var i in pos_id){
					var can_name=[];
					var can_votes=[];
					var coloR=[];
					for(var j in data) {
						 if(pos_id[i]==data[j].id){
							 var name=data[j].firstname.concat(" "+data[j].lastname);
							 can_name.push(name);
							 can_votes.push(data[j].c_votes); 
							 coloR.push(dynamicColors());
						 }	 
					}
					
					var new_Canvas = document.createElement("canvas");
					new_Canvas.id=pos_name[i];
					new_Canvas.class="graphs";
					graphs_Div.appendChild(new_Canvas);
					var ctx=document.getElementById(pos_name[i]).getContext('2d');
					var myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: can_name,
							datasets: [{
								label: pos_name[i],
								data: can_votes,
							    backgroundColor: coloR,
								borderColor: coloR,
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							},
							responsive:false,
							maintainAspectRatio: false,
						}
					});
				}
			}
			,
			error:function(data){
				console.log(data);
			}
			
		});
            
        
	});
</script>
</body>
</html>
