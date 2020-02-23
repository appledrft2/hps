
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
<?php 
 		if(isset($_POST['btnAddEmployee'])){
 			$status = "Unpaid";
 			$sql ="INSERT INTO schedule_employee(schedule_id,employee_id,status) VALUES(?,?,?)";
 			$qry->prepare($sql);
 			$qry->bind_param('iis',$_GET['id'],$_POST['employee_id'],$status);
 			if($qry->execute()) {

 				
 			}
 			echo "<script>window.location.href='payroll_list.php'?id='".$_GET['id']."'</script>";
 		}
 	?>
 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Manage Schedule Employee</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Job (Rate is determined by the job)</label>
						
							<?php 
									$sql = "SELECT id,name,rate FROM job WHERE id=?";
									$qry = $connection->prepare($sql);
									$qry->bind_param('i',$dbj);
									$qry->execute();
									$qry->bind_result($id,$dbn,$dbr);
									$qry->store_result();
									while($qry->fetch ()) {
											echo"<input  value='".$dbn."' class='form-control' readonly>";
											
										
									};
							?>
						
					</div>
					<div class="form-group">
						<label>Date</label>
						<input readonly type="date" class="form-control" name="date" value="<?php echo $dbd ?>">
					</div>
				</div>
			

				<div class="col-md-6">
									<label>List of Employee</label>
									<div class="form-group">
										
										<table class="table table-bordered table-striped ">
											<thead class="bg-success text-white">
												<tr>
													<th>Employee Name</th>
													<th width="20%">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$sql = "SELECT * FROM schedule_employee WHERE schedule_id = ?";
													$qry = $connection->prepare($sql);
													$qry->bind_param('i',$_GET['id']);
													$qry->execute();
													$qry->bind_result($id,$dbs, $dbe,$dbs);
													$qry->store_result();

													while($qry->fetch ()) {
														$sql2 = "SELECT id,firstname,lastname FROM employee WHERE id = ?";
														$qry2 = $connection->prepare($sql2);
														$qry2->bind_param('i',$dbe);
														$qry2->execute();
														$qry2->bind_result($eeid,$dbf, $dbl);
														$qry2->store_result();
														$qry2->fetch ();



														echo "<tr>";
														echo "<td>";
														echo $dbf." ".$dbl;
														echo "</td>";
														echo "<td>";
														echo '
															<a href="delete_schedule_employee.php?id='.$id.'&sid='.$_GET['id'].'"';?> onclick="return confirm('do you really want to delete this record?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
														echo"</td>";
														echo "</tr>";

													}

												?>
												<form id="freshme" method="POST" action="#">
													<tr>
													<td>
													
															<select name="employee_id" class="form-control select2">
																<option selected disabled value="">Select Employee</option>
																<?php 
																		$sql2 = "SELECT id,firstname,lastname  FROM employee";
																		$qry2 = $connection->prepare($sql2);
																		$qry2->execute();
																		$qry2->bind_result($id,$dbf,$dbl);
																		$qry2->store_result();
																		while($qry2->fetch ()) {
																		
																				echo"<option value='".$id."'>";
																				echo $dbf." ".$dbl;
																				echo"</option>";
																			
																		};
																?>
															</select>
															
													</td>
													<td><button name="btnAddEmployee" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button></td>
												</tr>
												</form>
											</tbody>
										</table>
									</div>
								</div>
			</div>


		</div>
		<div class="box-footer" >
			<a href="schedule_list.php" class="btn btn-warning"> Back to List</a>
		
			
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
<script type="text/javascript">
	$("#freshme").load(location.href + " #freshme");
</script>

