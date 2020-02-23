
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h2>New Employee</h2>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>First Name </label>
						<input required type="text" class="form-control" name="firstname">
					</div>
					
					
					<div class="form-group">
						<label>Lastname </label>
						<input required type="text" class="form-control" name="lastname">
					</div>
					<div class="form-group">
						<label>Address </label>
						<textarea class="form-control" name="address" placeholder="Enter Address"></textarea>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Contact </label>
						<input required type="text" class="form-control" name="contact">
					</div>
					<div class="form-group">
						<label>Gender </label>
						<select class="form-control " name="gender">
							<option selected disabled value="">Select Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
					
					
				</div>
			</div>


		</div>
		<div class="box-footer" >
			<button onclick="history.back()" class="btn btn-warning"> Cancel</button>
			<button name="btnAdd" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnAdd'])){
 	 		$sql = "INSERT INTO employee(firstname,lastname,contact,gender,address) VALUES(?,?,?,?,?)";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sssss",$_POST['firstname'],$_POST['lastname'],$_POST['contact'],$_POST['gender'],$_POST['address']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=employee_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=employee_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

