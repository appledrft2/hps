
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM cash_advance WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param('i',$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbeid, $dba,$dbd,$dbs);
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
										<label>Employee </label>
										<select class="form-control" required name="employee_id">
											<option selected disabled value="">Select Employee</option>
											<?php 
													$sql = "SELECT id,firstname,lastname FROM employee";
													$qry = $connection->prepare($sql);
													$qry->execute();
													$qry->bind_result($id,$dbf,$dbl);
													$qry->store_result();
													while($qry->fetch ()) {

														if($dbeid == $id){
															echo"<option selected value='".$id."'>";
															echo $dbf." ".$dbl;
															echo"</option>";
														}else{
															echo"<option value='".$id."'>";
															echo $dbf." ".$dbl;
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
										<input placeholder="Enter Date" required value="<?php echo $dbd ?>" type="date" class="form-control" name="date">
									</div>
									<div class="form-group">
										<label>Amount</label>
										<input placeholder="Enter Amount" required value="<?php echo $dba ?>" type="text" class="form-control" name="amount">
									</div>
								</div>
							</div>
			</div>


		</div>
		<div class="box-footer" >
			<a href="cash_advance_list.php" class="btn btn-warning"> Cancel</a>
			<button name="btnUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE cash_advance SET employee_id=?,amount=?,date=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("issi",$_POST['employee_id'],$_POST['amount'],$_POST['date'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=cash_advance_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=cash_advance_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

