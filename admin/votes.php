<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
	
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="votes.php"><i class="fas fa-vote-yea"></i>&nbsp;Votes</a></li>
			</ol>
		</nav>
	<div class="box">
        <div class="box-header with-border">
            <h5>Candidate Votes</h5>
        </div>
	<table id="votes" class="table table-striped table-bordered table-hover table-sm  table-responsive-sm">
            <thead>
                    <th>Sl. No</th>
                    <th>Position</th>
                    <th>Candidate Name</th>
                    <th>Votes</th>
            </thead>
            <tbody>
			<?php 
					$sql = "SELECT id,position_name FROM positions ORDER BY priority ASC";
					$query = $conn->query($sql);
					$i=0;
					while($row = $query->fetch_assoc()){
						$sql = "SELECT candidate_id,firstname,lastname FROM candidates WHERE position_id = '".$row['id']."'";
						$cquery = $conn->query($sql);
						while($c_row = $cquery->fetch_assoc()){
							$sql = "SELECT c_votes FROM candidate_votes WHERE position_id='".$row['id']."' AND candidate_id = '".$c_row['candidate_id']."'";
							$vquery = $conn->query($sql);
							$v_row=$vquery->fetch_assoc();
						    $i++;
							echo "<tr><td>".$i."</td><td>".$row['position_name']."</td><td>".$c_row['firstname']."</td><td>".$v_row['c_votes']."</td></tr>";
						}
					}
			?>
			</tbody>
			
    </table>
	</div>
		<div class="box">
        <div class="box-header">
            <h5>Voters Voted</h5>
        </div>
		<div class="box-body">
			<table id="voters_voted" class="table table-striped table-bordered table-hover table-sm  table-responsive-sm">
				<thead>
						<th>Serial no</th>
						<th>Registration Number</th>
						<th>Time Stamp</th>
				</thead>
				<tbody>
					<?php      
					$query="SELECT * FROM voters_voted";
					$result=$conn->query($query);
					$i=1;
					while($row=$result->fetch_assoc())
					{
						echo "<tr><td>".$i."</td><td>".$row['reg_no']."</td><td>".$row['time_stamp']."</td></tr>";
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
				</div>
	<script>
    $(document).ready(function(){
		$('#voters_voted').DataTable({
			dom: 'Bfrtip',
			lengthMenu:[[5,10,25,50,100,-1],['5 rows','10 rows','25 rows','50 rows','100 rows','Show all rows']],
			buttons: [
				{extend: 'pageLength', className:'btn-light'},
				{extend:'copyHtml5',className:'btn-light',title:'Voters Voted'},
				{extend:'excelHtml5',className:'btn-light',title:'Voters voted'},
				{extend:'pdfHtml5',className:'btn-light',title:'Voters voted'},
				{extend:'print',className:'btn-light',title:'Voters Voted'},
			],   
		});
		
		$('#votes').DataTable({
			dom: 'Bfrtip',
			lengthMenu:[[5,10,25,50,100,-1],['5 rows','10 rows','25 rows','50 rows','100 rows','Show all rows']],
			buttons: [
				{extend: 'pageLength', className:'btn-light'},
				{extend:'copyHtml5',className:'btn-light',title:'Total votes'},
				{extend:'excelHtml5',className:'btn-light',title:'Total votes'},
				{extend:'pdfHtml5',className:'btn-light',title:'Total votes'},
				{extend:'print',className:'btn-light',title:'Total votes'},
			],   
		});
    });
	
	</script>	
    </body>
</html>