<?php
	require './includes/connection.php';
	include './includes/menu_nav.php'; 
?>

<div class="content">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="candidates.php"><i class="fas fa-user-tie"></i>&nbsp;Candidates</a></li>
        </ol>
		</nav>

	<div class="modal fade" id="add_candidate_modal" tabindex="-1" aria-labelledby="add_candidate_modal" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add Candidate</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form id="add_candidate" action="./includes/add_candidate.php" method="POST" enctype="multipart/form-data">
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">First Name</span>
					</div>
					<input type="text" class="form-control" name="first_name" id="first_name" required>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Last Name</span>
					</div>
					<input type="text" class="form-control" name="last_name" id="last_name" required>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Position</span>
					</div>
					<select class="form-control" id="position_id" name="position_id" required>
						<option value="">-SELECT-</option>
							<?php $query="SELECT * FROM positions ORDER BY priority ASC";
							$result=$conn->query($query);
							while($p_row=$result->fetch_assoc()){
								echo"<option value='".$p_row['id']."'>".$p_row['position_name']."</option>";
							}
							?>
					</select>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Photo</span>
					</div>
					<input type="file" class="form-control" name="photo" id="photo" accept=".png,.jpg,.jpeg">
					
				</div>			

				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Description</span>
					</div>
					<textarea name="description" class="form-control" id="description"  maxlength = "600" placeholder="Maximum 100 words(600 charcters)."></textarea>
				</div>	
			</form>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">Close</button>
			<button type="submit" form="add_candidate" class="btn btn-primary" name="add_candidate" id="form_submit">Add Candidate</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="box">
		<div class="box-header">
			<h5>Candidates List</h5>
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered table-hover table-sm table-responsive-sm " id="candidates_table" width="100%">
				<thead>
						<th>Sl. No</th>
						<th hidden>Position ID</th>
						<th>Position</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Photo</th>
						<th>Description</th>
						<th>Actions</th>
				</thead>
				<tbody>
					<?php
						$query="SELECT * FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id ORDER BY positions.priority ASC";
						$result = $conn->query($query);
						$i=1;
						while($row = $result->fetch_assoc()){
							$image=(!empty($row['photo']))? '../images/'.$row['photo']: '../images/profile.jpg';
							echo "
							<tr>
							<td>".$i."</td>                              
							<td hidden>".$row['position_id']."</td>                              
							<td>".$row['position_name']."</td>
							<td>".$row['firstname']."</td>
							<td>".$row['lastname']."</td>
							<td><a href='#' class='image-hover' id='".$row['photo']."'><img src=".$image." class='image-hover'  data-id='".$row['candidate_id']."'></td>
							<td>".$row['description']."</a></td>
							<td><a class='edit_candidate' title='Edit Candidate'  data-id='".$row['candidate_id']."' data-toggle='tooltip' ><i class='fas fa-edit'></i></a>
							    <a class='delete_candidate' title='Delete Candidate' data-id='".$row['candidate_id']."' data-toggle='tooltip'><i class='fas fa-trash-alt'></i></a>
							</td>
							</tr>
							";
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_candidate_modal"><i class="fa fa-plus" aria-hidden="true"></i> Add New Candidate</button>
	</div>
	
	
	<div class="modal fade" id="edit_candidate_modal" tabindex="-1" aria-labelledby="edit_candidate_modal" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" >Edit Candidate</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form id="edit_candidate" action="./includes/edit_candidate.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" class="position-id" name="pos_id">
				<input type="hidden" class="candidate-id" name="can_id">
				<div class="img"><img src="" class="rounded mx-auto d-block" width='150' height='150' alt="image" id="img_photo"></div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">First Name</span>
					</div>
					<input type="text" class="form-control" name="first_name" id="edit_firstname" required>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Last Name</span>
					</div>
					<input type="text" class="form-control" name="last_name" id="edit_lastname" required>
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Edit Photo</span>
					</div>
					<input type="file" class="form-control" name="photo" id="edit_photo" accept=".png,.jpg,.jpeg">							
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Position</span>
					</div>
					<select class="form-control"id="edit_position" name="position" required>
						<option value="">-SELECT-</option>
							<?php $query="SELECT * FROM positions ORDER BY priority ASC";
							$result=$conn->query($query);
							while($p_row=$result->fetch_assoc()){
								echo"<option value='".$p_row['id']."'>".$p_row['position_name']."</option>";
							}
							?>
					</select>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
								 <span class="input-group-text">Description</span>
					</div>
					<textarea  class="form-control" name="description" id="edit_description"  maxlength = "600" placeholder="Maximum 100 words(600 charcters)."></textarea>
				</div>	
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="edit_candidate" class="btn btn-primary" name="edit_candidate" id="edit_form_submit">Save</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="delete_candidate_modal" tabindex="-1" role="dialog" aria-labelledby="delete_candidate_modal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Delete Candidate</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		   <form id="delete_candidate" class="forms-body" method="POST" action="./includes/delete_candidate.php">
					<input type="hidden" class="position-id" name="pos_id">
					<input type="hidden" class="candidate-id" name="can_id">
					<div class="text-center">
						<h2></h2>
					</div>
		   </form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" form="delete_candidate" class="btn btn-primary" name="delete_candidate">Delete</button>
		  </div>
		</div>
	  </div>
	</div>
	
</div>
<style>
		.img{
			padding: 10px;
			margin-bottom: 10px;
		}
		
        .forms-body span{
            margin-left: 5px;
            margin-bottom: 5px;
            width: 150px;
        }
        .box-body{
			box-sizing: border-box;
			/* display: block; */
		}
        /* #data-show{
			padding:20px;
            background-color: white ;
        } */
		.table{
			text-align: center;
		}
        table.table td .add {
            display: none;
        }
        
        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }
        
        table.table td a.add {
            color: #27C46B;
        }
        
        table.table td a.edit_candidate {
            color: #FFC107;
        }
        
        table.table td a.delete_candidate {
            color: #E34724;
        }
        
        table.table td i {
            font-size: 19px;
        }
        
        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }
		.table{
			align-content: center;
		}
		.image-hover {
			border-radius: 5px;
			height:30px;
			transition: transform .2s; 
		}
		.image-hover:hover {
			background-color:white;
			transform: scale(2.2);
		}
    </style>
<script type="text/javascript">
$(document).ready(function() {
	$('#candidates_table').DataTable({
			dom: 'Bfrtip',
			lengthMenu:[[5,10,25,-1],['5 rows','10 rows','25 rows','Show all rows']],
			buttons: [
				{extend: 'pageLength', className:'btn-light'},
				{extend:'copyHtml5',className:'btn-light',exportOptions:{columns:[0,2,3,4,5,6]},title:'Candidates'},
				{extend:'excelHtml5',className:'btn-light',exportOptions:{columns:[0,2,3,4,5,6],stripHtml:true},title:'Candidates'},
				{extend:'print',className:'btn-light',exportOptions:{columns:[0,2,3,4,5,6],stripHtml:false},title:'Candidates'},
			],   
	});
});
$(document).ready(function(){
	$(document).on('click', '.edit_candidate', function(){
	var can_id = $(this).data('id');
	var tr = $(this).closest('tr');
    var pos_id = $(tr).find('td').eq(1).text();
    getCandidateRow(pos_id,can_id);
	$('#edit_candidate_modal').modal('show');
  });

  $(document).on('click', '.delete_candidate', function(){
    var can_id = $(this).data('id');
	var tr = $(this).closest('tr');
    var pos_id = $(tr).find('td').eq(1).text();
    getCandidateRow(pos_id,can_id);
	$('#delete_candidate_modal').modal('show');
  });
});

function getCandidateRow(pos_id,can_id){
  $.ajax({
    type: 'POST',
    url: './includes/get_candidate_info.php',
    data: {pos_id:pos_id,can_id:can_id},
    dataType: 'JSON',
    success: function(response){
		$('.position-id').val(response.position_id);
		$('.candidate-id').val(response.candidate_id);
		$('#delete_candidate h2').html(response.firstname+" "+response.lastname);
		$('#edit_firstname').val(response.firstname);
		$('#edit_lastname').val(response.lastname);
		var photo;
		if(response.photo==""){
			photo="profile.jpg";
		}else{
			photo=response.photo;
		}
		$('#img_photo').attr('src','../images/'+photo);
		$('#edit_position').val(response.position_id);     
		$('#edit_description').val(response.description);     
    }
  });
}  
</script>     
</body>
</html>