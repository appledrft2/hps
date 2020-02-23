
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h2>Issue Cash Advance</h2>
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
										echo"<option value='".$id."'>";
										echo $dbf." ".$dbl;
										echo"</option>";
									};
							?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Date</label>
						<input placeholder="Enter Date" required type="date" class="form-control" name="date">
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input placeholder="Enter Amount" required type="text" class="form-control" name="amount">
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
 	 		$sql = "INSERT INTO cash_advance(employee_id,date,amount,status) VALUES(?,?,?,'Unpaid')";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sss",$_POST['employee_id'],$_POST['date'],$_POST['amount']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=cash_advance_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=cash_advance_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

