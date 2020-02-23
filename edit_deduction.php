
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM deduction WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param('i',$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbn, $dbr,$dbd);
		$qry->store_result();
		$qry->fetch ();
	}

?>
 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Edit Job</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Name </label>
						<input placeholder="Enter Name" required value="<?php echo $dbn ?>" type="text" class="form-control" name="name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Salary Range</label>
						<input placeholder="Enter Range" required value="<?php echo $dbr ?>" type="text" class="form-control" name="range">
					</div>
					<div class="form-group">
						<label>Deduction</label>
						<input placeholder="Enter Deduction" required value="<?php echo $dbd ?>" type="text" class="form-control" name="deduction">
					</div>
				</div>
			</div>


		</div>
		<div class="box-footer" >
			<a href="job_list.php" class="btn btn-warning"> Cancel</a>
			<button name="btnUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE deduction SET name=?,salary_range=?,deduction=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sssi",$_POST['name'],$_POST['range'],$_POST['deduction'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=deduction_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=deduction_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

