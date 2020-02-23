<?php $title = "Payroll List" ?>
<?php include('header.php'); ?>


 
<!-- Main content -->
<section class="content">
	<?php 
	$sql = "SELECT * FROM employee WHERE id=?";
	$qry = $connection->prepare($sql);
	$qry->bind_param('i',$_GET['id']);
	$qry->execute();
	$qry->bind_result($id,$dbf, $dbl,$dbc,$dbg,$dba);
	$qry->store_result();
	$qry->fetch();

	
	?>
	<div class="box">
		<form method="POST" action="#">
		<div class="box-header">
			<h2 class="text-center">Payslip</h2>
			<div class="row">

				<div class="col-md-6">
					<div class="form-group">
						<label>Date Issued</label>
						<input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" >

					</div>
					
				</div>


				<div class="col-md-6">
					<div class="form-group">
						<label>Payslip code</label>
						<input type="text" readonly name="payslip_code" class="form-control" value="<?php echo "P".rand(11111,9999); ?>">
					</div>
					<div class="form-group">
						<label>Employee Name</label>
						<input type="text" readonly class="form-control" value="<?php echo $dbf." ".$dbl."" ?>">
					</div>
					
					
				</div>
			</div>
			
				
			
		</div>
		<div class="box-body">
			<h4>Weekly Work Schedule:</h4>
			<table id="" class="table table-striped table-bordered">
				<thead 	class="">
					<tr>
						<th>Work name</th>
						<th>Date</th>
						<th class="text-right">Rate</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM schedule_employee WHERE employee_id =? AND status='Unpaid' ORDER BY schedule_id ASC";
						$qry = $connection->prepare($sql);
						$qry->bind_param('i',$_GET['id']);
						$qry->execute();
						$qry->bind_result($id,$dbsid,$dbeid,$dbs);
						$qry->store_result();
						$sum = 0;
						while($qry->fetch ()) {

							$sql2 = "SELECT schedule.id,job.name,schedule.date,job.rate FROM schedule LEFT JOIN job ON job.id = schedule.job_id WHERE schedule.id = ?";
							$qry2 = $connection->prepare($sql2);
							$qry2->bind_param('i',$dbsid);
							$qry2->execute();
							$qry2->bind_result($schedid,$dbn,$dbd,$dbr);
							$qry2->store_result();
							$qry2->fetch ();

							echo"<tr>";
							echo"<td>";
							echo $dbn;
							echo"</td>";
							echo"<td>";
							echo $dbd;
							echo"</td>";
							echo"<td class='text-right'>";
							echo $dbr;
							echo"</td>";
							
							
							echo"</tr>";

							
							echo '<input type="hidden" name="schedule_arr[]" value="'.$schedid.'">';

							$sum = $sum + $dbr;
						}


						if(empty($id)){
							echo "<script>alert('This employee has no work schedule yet.')</script>";

							echo '<meta http-equiv="refresh" content="0; URL=payroll_list.php">';

						}
					?>
					
					
				</tbody>
			</table>
			<h4>Deductions (divided by 4 weeks):</h4>
			<table id="" class="table table-striped table-bordered">
				<thead 	class="">
					<tr>
						<th>Name</th>
						<th class="text-right">Deduction</th>
						
					</tr>
				</thead>
				<tbody>

					<?php 
						$sql = "SELECT * FROM deduction";
						$qry = $connection->prepare($sql);
						$qry->execute();
						$qry->bind_result($id,$dbn, $dbsr,$dbd);
						$qry->store_result();

						

						while($qry->fetch ()) {
							$weekdbd = $dbd / 4 ;
							echo"<tr>";
							echo"<td>";
							echo $dbn;
							echo"</td>";
							echo"</td>";
							echo"<td class='text-right'>";
							echo $weekdbd;
							echo"</td>";
							
							
							echo"</tr>";

							
								$sum = $sum - $weekdbd;	
							
							
						}

					?>

				</tbody>
			</table>
			<h4>Cash Advance:</h4>
			<table id="" class="table table-striped table-bordered">
				<thead 	class="">
					<tr>
						<th>Date</th>
						<th class="text-right">Amount</th>
						
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM cash_advance WHERE employee_id=? AND status ='Unpaid' ";
						$qry = $connection->prepare($sql);
						$qry->bind_param('i',$_GET['id']);
						$qry->execute();
						$qry->bind_result($caid,$dbeid, $dba,$dbd,$dbs);
						$qry->store_result();

						while($qry->fetch ()) {
							echo"<tr>";
							echo"<td>";
							echo $dbd;
							echo"</td>";
							echo"</td>";
							echo"<td class='text-right'>";
							echo $dba;
							echo"</td>";
							
							
							echo"</tr>";

							$sum = $sum - $dba;

							echo '<input type="hidden" name="cashadvance_arr[]" value="'.$caid.'">';
						}

						if(empty($caid)){
							echo "<tr>";
							echo "<td colspan='2' class='text-center'>";
							echo "No Cash Advance";
							echo "</td>";
							echo "</tr>";
						}

					?>
					
				</tbody>
			</table>
			<h4>Total:</h4>
			<table id="" class="table table-striped table-bordered">
				
				<thead 	class="">
					<tr>
						<th class="text-right">Total</th>
						
						
					</tr>
				</thead>
					<tr >
						
						<td class="text-right"><?php echo $sum; ?>
							<input type="hidden" name="total" value="<?php echo $sum; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right"><button type="submit" onclick="return confirm('do you really want to process this record?')" name="btnProcess" class="btn btn-success">PROCESS PAYSLIP</button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
	</div>
 

</section>

<?php 
	if(isset($_POST['btnProcess'])){



		$sql = "INSERT INTO payslip(employee_id,payslip_code,date,total) VALUES(?,?,?,?)";
		$qry = $connection->prepare($sql);
		$qry->bind_param('isss',$_GET['id'],$_POST['payslip_code'],$_POST['date'],$_POST['total']);
		$qry->execute();

		$last_id = $connection->insert_id;
		
		// insert/update schedule to paid
		foreach($_POST['schedule_arr'] as $sid) {
			$sql2 = "UPDATE schedule_employee SET status='Paid' WHERE schedule_id=? AND employee_id=?";
			$qry2 = $connection->prepare($sql2);
			$qry2->bind_param('ii',$sid,$_GET['id']);
			$qry2->execute();

			$sql3 = "INSERT INTO payslip_schedule(schedule_id,payslip_id) VALUES(?,?)";
			$qry3 = $connection->prepare($sql3);
			$qry3->bind_param('ii',$sid,$last_id);
			$qry3->execute();


		}
		if(isset($_POST['cashadvance_arr'])){
			// insert/update cash advance to paid
			foreach($_POST['cashadvance_arr'] as $caid) {
				$sql4 = "UPDATE cash_advance SET status='Paid' WHERE employee_id=?";
				$qry4 = $connection->prepare($sql4);
				$qry4->bind_param('i',$_GET['id']);
				$qry4->execute();

				$sql3 = "INSERT INTO payslip_cash_advance(cash_advance_id,payslip_id) VALUES(?,?)";
				$qry3 = $connection->prepare($sql3);
				$qry3->bind_param('ii',$caid,$last_id);
				$qry3->execute();


			}
		}

		echo "<script>window.location.href='payroll_list.php'</script>";

	}
?>

<?php include('footer.php'); ?>

