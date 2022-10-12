<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
	  <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="positions.php"><i class="fas fa-tasks"></i><span>&nbsp;Positions</a></li>
		</ol>
	  </nav>
	
	<div class="box">
		<div class="box-header">
			<h5>Positions List</h5>
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-sm  table-responsive-sm" id="position_table" width="100%">
				<thead>
					<th>Sl. No</th>
					<th>Position Name</th>
					<th>Priority</th>
					<th>Actions</th>
				</thead>
				<tbody>
				<?php
					$query = "SELECT * FROM positions ORDER BY priority ASC";
					$result = $conn->query($query);
					$i=1;
					while($row = $result->fetch_assoc()){
						echo "
							<tr>
							<td>".$i."</td>
							<td>".$row['position_name']."</td>
							<td>".$row['priority']."</td>
							<td><a class='edit_position' title='Edit' data-id='".$row['id']."'><i class='fas fa-edit'></i></a>
								<a class='delete_position' title='Delete' data-id='".$row['id']."'><i class='fas fa-trash-alt'></i></a>
							</td>
							</tr>";
						$i++;
					}
				?>
				</tbody>
			</table>
		</div>
	</div>	
	
	<div class="box">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_position_modal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Position</button>
	</div>
	
	<div class="modal fade" id="add_position_modal" tabindex="-1" role="dialog" aria-labelledby="add_position_modal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Position</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="add_position" action="./includes/add_position.php" method="POST">	
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Position Name</span>
							</div>
							<input type="text" class="form-control" name="position_name" id="position_name" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Priority</span>
							</div>
							<input type="number" class="form-control" name="priority" id="priority" min="1" max="10" required>
						</div>
						
						<button type="button" class="btn btn-primary" onclick="check()">Check</button>
						<div id="add-position-result">
						
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">Close</button>
					<button type="submit" form="add_position" class="btn btn-primary" id="add-position-submit" name="add_position" disabled>Add Position</button>
				</div>
			</div>
		</div>
	</div>  
	
	<div class="modal fade" id="edit_position_modal" tabindex="-1" role="dialog" aria-labelledby="edit_voter_modal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Edit Position</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		   <form id="edit_position" method="POST" action="./includes/edit_position.php">
					<input type="hidden" class="position-id" id="edit_position_id" name="pos_id" required></input>
					<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Position Name</span>
							</div>
							<input type="text" class="form-control" name="position_name" id="edit_position_name" required>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Priority</span>
						</div>
						<input type="number" class="form-control" name="priority" id="edit_priority">
					</div>
					<button type="button" class="btn btn-primary" onclick="editsCheck()">Check</button>
					<div id="edit-position-result">
						
					</div>
		   </form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="edit_position" class="btn btn-primary" id="edit-position-submit" name="edit_position" disabled>Update</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="delete_position_modal" tabindex="-1" role="dialog" aria-labelledby="delete_voter_modal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Delete Position</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form id="delete_position" class="forms-body" method="POST" action="./includes/delete_position.php">
					<input type="hidden" class="position-id" name="pos_id" required></input>
					<div class="text-center">
						<h2></h2>
					</div>
		   </form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="delete_position" class="btn btn-primary" name="delete_position">Delete</button>
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
table td a.edit_position {
	color: #FFC107;
}

table td a.delete_position {
	color: #E34724;
}
</style> 
<script type="text/javascript">

    $(document).ready(function(){
		$(document).on('click', '.delete_position', function(){
			var pos_id= $(this).data('id');
			$('#delete_position_modal').modal('show');
			$('.position-id').val(pos_id);
			getPositionRow(pos_id);	
		});
		$(document).on('click', '.edit_position', function(){
			var pos_id = $(this).data('id');
			$('#edit-position-result').html(' ');
			$('#edit_position_modal').modal('show');			
			$('.position-id').val(pos_id);
			getPositionRow(pos_id);	
		});
		
		$('#position_table').DataTable({
			dom: 'Bfrtip',
			lengthMenu:[[5,10,25,50,100,-1],['5 rows','10 rows','25 rows','50 rows','100 rows','Show all rows']],
			buttons: [
				{extend: 'pageLength', className:'btn-light'},
				{extend:'copyHtml5',className:'btn-light',columns:[0,1,2],title:'Positions'},
				{extend:'excelHtml5',className:'btn-light',exportOptions:{columns:[0,1,2]},title:'Positions'},
				{extend:'pdfHtml5',className:'btn-light',exportOptions:{columns:[0,1,2]},title:'Positions'},
				{extend:'print',className:'btn-light',exportOptions:{columns:[0,1,2]},title:'Positions'},
			],   
		});
    });
	
	function check() {
		if(!$('#add_position input').val()){
			alert('Empty fields!!!!!');
		}
		else if(!$('#position_name').val()){
			alert('Please enter position name');
		}
		else if(!$('#priority').val()){
			alert('Please Enter the priority');
		}
		else{
			var position_name = $("#position_name").val();
			var priority = $("#priority").val();
            $.post('./includes/check_position.php', {
                    'position_name': position_name,
					'priority': priority,
                },
                function(data) {
                    if (data == "success") {
						 $('#add-position-result').html(' ');
                        $('#add-position-submit').prop('disabled', false);
                    } else {
						 $('#add-position-result').html('<div class="alert alert-danger" role="alert">Position or position with same priority is already present</div>');
                        $('#add-position-submit').prop('disabled', true);
                    }
                });
        }
	}
	
	function editsCheck() {
		if(!$('#edit_position input').val()){
			alert('Empty fields!!!!!');
		}
		else if(!$('#edit_position_name').val()){
			alert('Please enter position name');
		}
		else if(!$('#edit_priority').val()){
			alert('Please Enter the priority');
		}
		else{
			var pos_id =$("#edit_position_id").val();
			var position_name = $("#edit_position_name").val();
			var priority = $("#edit_priority").val();
            $.post('./includes/check_position.php', {
                    'pos_id': pos_id,
                    'position_name': position_name,
					'priority': priority,
                },
                function(data) {
                    if (data == "success") {
						$('#edit-position-result').html(' ');
                        $('#edit-position-submit').prop('disabled', false);
                    } else{                      
						$('#edit-position-result').html('<div class="alert alert-danger" role="alert">Position or position with same priority is already present</div>');
                        $('#edit-position-submit').prop('disabled', true);
                    }
                });
        }
	}
	
	function getPositionRow(pos_id){
		$.ajax({
		type: 'POST',
		url: './includes/get_position_info.php',
		data: {pos_id:pos_id},
		dataType: 'JSON',
		success: function(response){
			  $('#edit_position_name').val(response.position_name);
			  $('#edit_priority').val(response.priority);
			  $('#delete_position h2').html(response.position_name);
		}
        });
    }

</script>
</body>
</html>