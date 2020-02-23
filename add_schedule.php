
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h2>New Work Schedule</h2>
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
										echo"<option value='".$id."'>";
										echo $dbn;
										echo"</option>";
									};
							?>
						</select>
					</div>
					
				</div>
				<div class="col-md-6">
					
					<div class="form-group">
						<label>Date</label>
						<input type="date" class="form-control" name="date" >
					</div>
					
				</div>
				
			</div>


		</div>
		<div class="box-footer" >
			<a href="schedule_list.php" class="btn btn-warning"> Cancel</a>
			<button name="btnAdd" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnAdd'])){
 	 		$sql = "INSERT INTO schedule(job_id,date) VALUES(?,?)";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ss",$_POST['job_id'],$_POST['date']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=schedule_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=schedule_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>
