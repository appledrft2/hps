
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM employee WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param('i',$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbf, $dbl,$dbc,$dbg,$dba);
		$qry->store_result();
		$qry->fetch ();
	}

?>
 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Edit Employee</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>First Name </label>
						<input required value="<?php echo $dbf; ?>" type="text" class="form-control" name="firstname">
					</div>
					
					
					<div class="form-group">
						<label>Lastname </label>
						<input required value="<?php echo $dbl; ?>" type="text" class="form-control" name="lastname">
					</div>
					<div class="form-group">
						<label>Address </label>
						<textarea class="form-control"  name="address" placeholder="Enter Address"><?php echo $dba; ?></textarea>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Contact </label>
						<input required value="<?php echo $dbc; ?>" type="text" class="form-control" name="contact">
					</div>
					<div class="form-group">
						<label>Gender </label>
						<select class="form-control " name="gender">
							<option selected disabled value="">Select Gender</option>
							<option <?php if($dbg=='Male') echo 'selected'; ?>>Male</option>
							<option <?php if($dbg=='Female') echo 'selected'; ?>>Female</option>
						</select>
					</div>
					
					
				</div>
			</div>


		</div>
		<div class="box-footer" >
			<a href="employee_list.php" class="btn btn-warning"> Cancel</a>
			<button name="btnUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE employee SET firstname=?,lastname=?,contact=?,address=?,gender=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sssssi",$_POST['firstname'],$_POST['lastname'],$_POST['contact'],$_POST['address'],$_POST['gender'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=employee_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=employee_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

