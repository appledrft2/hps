
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM schedule WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param('i',$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbj, $dbd);
		$qry->store_result();
		$qry->fetch ();
	}

?>
 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Edit Work Schedule</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Job (Rate is determined by the job)</label>
						<select class="form-control select2" name="job_id">
							<option selected disabled  value="">Select Job</option>
							<?php 
									$sql = "SELECT id,name,rate FROM job";
									$qry = $connection->prepare($sql);
									$qry->execute();
									$qry->bind_result($id,$dbn,$dbr);
									$qry->store_result();
									while($qry->fetch ()) {
										if($dbj == $id){
											echo"<option selected value='".$id."'>";
											echo $dbn;
											echo"</option>";
										}else{
											echo"<option  value='".$id."'>";
											echo $dbn;
											echo"</option>";
										}
									};
							?>
						</select>
					</div>
					
				</div>
				<div class="col-md-6">
					
					<div class="form-group">
						<label>Date</label>
						<input type="date" class="form-control" name="date" value="<?php echo $dbd ?>">
					</div>
					
				</div>
			</div>


		</div>
		<div class="box-footer" >
			<a href="schedule_list.php" class="btn btn-warning"> Cancel</a>
			<button name="btnUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE schedule SET job_id=?,date=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ssi",$_POST['job_id'],$_POST['date'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=schedule_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=schedule_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

