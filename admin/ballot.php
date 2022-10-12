<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="candidates.php"><i class="fas fa-sliders-h"></i>&nbsp;Ballot Setings</a></li>
        </ol>
      </nav>
	<div class="box delete-reset">
		<div class="box-header">
			<h5>Reset / Delete</h5>
		</div>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deletePositionsModal"><i class="fas fa-eraser"></i>&nbsp;Delete all Positions</button>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deleteCandidatesModal"><i class="fas fa-eraser"></i>&nbsp;Delete all Candidates</button>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deleteVotersModal"><i class="fas fa-trash-alt"></i>&nbsp;Delete all Voters</button>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deleteAllClassesModal"><i class="fas fa-dumpster"></i>&nbsp;Delete all Classes</button>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetVotesModal"><i class="fas fa-sync"></i>&nbsp;Reset Votes</button>
	</div>

<div class="modal fade" id="deletePositionsModal" tabindex="-1" aria-labelledby="deletePositionsModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete All Positions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<p class="text-danger">You are going to delete all positions. This process cannot be undone.</p>
		<p class="text-danger">Enter Your Password to continue.</p>
		<form method="POST" action="./includes/delete_all_positions.php">
			<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text">Password</span>
					</div>
					<input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="confirm-submit">Delete</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCandidatesModal" tabindex="-1" aria-labelledby="deleteCandidatesModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete All Candidates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 	<p class="text-danger">You are going to delete all candidates. This process cannot be undone.</p>
		<p class="text-danger">Enter Your Password to continue.</p>
		<form method="POST" action="./includes/delete_all_candidates.php">
		<div class="input-group mb-3">
				<div class="input-group-prepend">
							<span class="input-group-text">Password</span>
				</div>
				<input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="confirm-submit">Delete</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteVotersModal" tabindex="-1" aria-labelledby="deleteVotersModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete all Voters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<p class="text-danger">You are going to delete all voters. This process cannot be undone.</p>
		<p class="text-danger">Enter Your Password to continue.</p>
		<form method="POST" action="./includes/delete_all_voters.php">
		<div class="input-group mb-3">
				<div class="input-group-prepend">
							<span class="input-group-text">Password</span>
				</div>
				<input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="confirm-submit">Delete</button>
		</form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteAllClassesModal" tabindex="-1" aria-labelledby="deleteAllClassesModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete All Classes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <p class="text-danger">You are going to delete all classes.This will also delete the voters. This process cannot be undone.</p>
		<p class="text-danger">Enter Your Password to continue.</p>
		<form method="POST" action="./includes/delete_all_classes.php">
		<div class="input-group mb-3">
				<div class="input-group-prepend">
							<span class="input-group-text">Password</span>
				</div>
				<input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="confirm-submit">Delete</button>
		</form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="resetVotesModal" tabindex="-1" aria-labelledby="resetVotesModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset All Votes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<p class="text-danger">You are going to reset all votes. This process cannot be undone.</p>
		<p class="text-danger">Enter Your Password to continue.</p>
		<form method="POST" action="./includes/reset_votes.php">
		<div class="input-group mb-3">
				<div class="input-group-prepend">
							<span class="input-group-text">Password</span>
				</div>
				<input type="password" class="form-control" placeholder="Enter your password" name="password-to-continue" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="confirm-submit">Save changes</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="box">
	<div class="box-header">
		<h5>Election Title Update</h5>
	</div>

	<form class="forms-body" id="title_update" method="POST" action="./includes/election_title_update.php">
		<div class="input-group mb-3">
			<div  class="input-group-prepend">
				<span class="input-group-text" >Election Title</span>
			</div>
			<?php
			$query = "SELECT title FROM election_title WHERE 1";
			$result = $conn->query($query);
			$row=$result->fetch_assoc();
			?>
			<input type="text" class="form-control" id="electionTitle" name="election-title" value="<?php echo $row['title'];?>">
		</div>
		<div class="col-auto">
			<button type="submit" class="btn btn-primary mb-3" name="title-submit">Update</button>
		</div>
	</form>
</div>

<div class="box">
	<div class="box-header with-border">
		<h5>Create Class</h5>
	</div>
	<form class="forms-body" id="create-class" method="POST" action="./includes/create_class.php">
		<div class="input-group mb-3">
			<div  class="input-group-prepend">
				<span class="input-group-text">Class Name</span>
			</div>
			<input type="text" class="form-control" name="class-name" id="class-name" onchange="checkEmpty()">
		</div>
		<div class="col-auto">
			<button type="submit" class="btn btn-primary" name="add-class-submit" id="add-class-submit" disabled>Create</button>
		</div>
	</form>
</div>

<div class="box">
	<div class="box-header with-border">
        <h5>Set default time </h5>
    </div>
	<form method="POST" action="./includes/set_default_time.php">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Start Time</span>
			</div>
			<input type="text" class="form-control" name="default_start_time" id="default_start_time" onchange="checkDefaultTime()">
			<div class="input-group-prepend">
				<span class="input-group-text">End Time</span>
			</div>
			<input type="text" class="form-control" name="default_end_time" id="default_end_time" onchange="checkDefaultTime()">
		</div>
		<div class="col-auto">
			<button type="submit" class="btn btn-primary" name="default-time-submit"  id="default-time-submit" disabled>Update</button>
		</div>
	</form>
</div>
	<div class="box">
        <div class="box-header with-border">
            <h5>Classes </h5>
        </div>
        <div class="box-body">
            <table id="classes_table" class="table table-striped table-bordered table-hover table-sm table-responsive-sm" width="100%">
                <thead>
                    <th>Sl. No</th>
                    <th>Class Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                    $query = "SELECT * FROM classes LEFT JOIN timings ON classes.id=timings.class_id";
                    $result = $conn->query($query);
                    $i=1;
					while($row = $result->fetch_assoc()){
						if($row['start_time']==null || $row['end_time']==null){
							$start=$row['start_time'];
							$end=$row['start_time'];
						}
						else{
							$start=date_format(date_create($row['start_time']),'d/m/Y H:i');
							$end=date_format(date_create($row['end_time']),'d/m/Y H:i');
						}
						echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".$row['class_name']."</td>
                          <td>".$start."</td>
                          <td>".$end."</td>
                          <td><a class='edit_class' title='Edit Class' data-id='".$row['id']."'><i class='fas fa-edit'></i></a>
						      <a class='delete_class' title='Delete Class' data-id='".$row['id']."'><i class='fas fa-trash-alt'></i></a>
                          </td>
                        </tr>";
                    $i++;
					}
                  ?>
                </tbody>
            </table>
        </div>
    </div>
	
	<div class="modal fade" id="edit_class_modal" tabindex="-1" role="dialog" aria-labelledby="edit_class_modal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Edit Class</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-style forms-body">
            <form action="./includes/edit_class.php" method="POST" id="edit_class">
				<input type="hidden" class="class-id" name="class_id" required>
				<input type="hidden" class="unique-id" name="unique_id" required>
				<div class="input-group mb-3">
                    <div class="input-group-prepend">
                             <span class="input-group-text">Class Name</span>
                    </div>
                    <input type="text" class="form-control" name="class_name" id="class_name" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                             <span class="input-group-text">Start Time</span>
                    </div>
                    <input type="text" class="form-control" name="start_time" id="start_time" onchange="checkTime()" required>
                </div><div class="input-group mb-3">
                    <div class="input-group-prepend">
                             <span class="input-group-text">End Time </span>
                    </div>
                    <input type="text" class="form-control" name="end_time" id="end_time" onchange="checkTime()" required>
                </div>
                <div id="form-result">

                </div>
            </form>
        </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="edit_class" class="btn btn-primary" name="edit-class-submit" id="edit-class-submit">Save</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="delete_class_modal" tabindex="-1" role="dialog" aria-labelledby="delete_class_modal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Delete Class</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-style forms-body">
				<form action="./includes/delete_class.php" method="POST" id="delete_class">
					<input type="hidden" class="class-id" name="class_id" required>
					<div class="text-center">
						<h2></h2>
					</div>
					<p class="text-danger">This will also delete the voters belonging to this class. This process cannot be undone.</p>
				</form>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="delete_class" class="btn btn-primary" name="delete-class-submit" id="delete-class-submit">Delete</button>
		  </div>
		</div>
	  </div>
	</div>
	
	
</div>
	
<style>
.table td a {
	cursor: pointer;
	display: inline-block;
	margin: 0 5px;
	min-width: 24px;
}
table td a.edit_class {
	color: #FFC107;
}

table.table td a.delete_class {
	color: #E34724;
}
.delete-reset .btn{
	margin:5px;
	width:200px;
}
</style>
<script>
$(document).ready(function(){
	$('#classes_table').DataTable({
			dom: 'Bfrtip',
			lengthMenu:[[5,10,25,50,100,-1],['5 rows','10 rows','25 rows','50 rows','100 rows','Show all rows']],
			buttons: [
				{extend: 'pageLength', className:'btn-light'},
				{extend:'copyHtml5',className:'btn-light',exportOptions:{columns:[0,1,2,3,4,]},title:'Classes'},
				{extend:'excelHtml5',className:'btn-light',exportOptions:{columns:[0,1,2,3,4],stripHtml:true},title:'Classes'},
				{extend:'print',className:'btn-light',exportOptions:{columns:[0,1,2,3,4],stripHtml:false},title:'Classes'},
			],   
	});
	$('#start_time').datetimepicker({
		minDate: new Date(),
		defaultSelect:true,
		step:30,
	});
	$('#end_time').datetimepicker({
		minDate: new Date(),
		defaultSelect:true,
		step:30,
	});
	$('#default_start_time').datetimepicker({
		minDate: new Date(),
		defaultSelect:true,
		step:30,
	});
	$('#default_end_time').datetimepicker({
		minDate: new Date(),
		defaultSelect:true,
		step:30,
	});
	$(document).on('click', '.edit_class', function(){
		$('#edit-result').html('');
		var id= $(this).data('id');
		var tr = $(this).closest('tr');
		var uniq_id = $(tr).find('td').eq(1).text();
		$('#edit_class_modal').modal('show');
		getClassRow(id,uniq_id);
	});

	$(document).on('click', '.delete_class', function(){
		var id= $(this).data('id');
		var tr = $(this).closest('tr');
		var uniq_id = $(tr).find('td').eq(1).text();
		$('#delete_class_modal').modal('show');
		getClassRow(id,uniq_id);
	});
});
function checkDefaultTime(){
	var dsrt=$('#default_start_time').val();
	var dent=$('#default_end_time').val();
	if(dsrt>dent){
		$('#default-time-submit').prop('disabled', true)
	}
	else{
		$('#default-time-submit').prop('disabled', false)
	}
}
function checkTime(){
	var srt=$('#start_time').val();
	var ent=$('#end_time').val();
	if(srt>ent){
		$('#edit-class-submit').prop('disabled', true)
	}
	else{
		$('#edit-class-submit').prop('disabled', false)
	}
}
function checkEmpty(){
	if($('#class-name').val()==''){
		$('#add-class-submit').prop('disabled', true)
	}
	else{
		$('#add-class-submit').prop('disabled', false)
	}
}

function getClassRow(id,uniq_id){
  $.ajax({
    type: 'POST',
    url: './includes/get_class_info.php',
    data: {id:id,uniq_id:uniq_id},
    dataType: 'JSON',
    success: function(response){
		let start_time=new moment(response.start_time).format('YYYY/MM/D HH:mm');
		let end_time = new moment(response.end_time).format('YYYY/MM/D HH:mm');
	 	$('.class-id').val(response.id);
	 	$('#class_name').val(response.class_name);
	 	$('#start_time').val(start_time);
	  	$('#end_time').val(end_time);
	  	$('#delete_class h2').html(response.class_name);
    }
  });
}
</script>
<style>
</style>
</body> 
</html>