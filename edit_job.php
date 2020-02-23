
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM job WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param('i',$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbn, $dbr);
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
						<label>Rate (per employee)</label>
						<input placeholder="Enter Rate" required value="<?php echo $dbr ?>" type="text" class="form-control" name="rate">
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
 	 		$sql = "UPDATE job SET name=?,rate=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ssi",$_POST['name'],$_POST['rate'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=job_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=job_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

