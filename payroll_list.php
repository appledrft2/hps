<?php $title = "Employee Payroll" ?>
<?php include('header.php'); ?>
<?php 

	if(isset($_POST['btnBulk'])){
			$checkrow = 0;
			// deduction
			$sql4 = "SELECT sum(deduction) FROM deduction";
			$qry4 = $connection->prepare($sql4);
			$qry4->execute();
			$qry4->bind_result($dbded);
			$qry4->store_result();
			$qry4->fetch ();

			$weekdbdsum = $dbded / 4;

			$sql = "SELECT DISTINCT(employee_id) FROM schedule_employee WHERE STATUS='Unpaid'";
			$qry = $connection->prepare($sql);
			$qry->execute();
			$qry->bind_result($employe_id);
			$qry->store_result();
			while($qry->fetch()){
				$today = date('Y-m-d');
				$payslip_code = "P".rand(11111,9999);
				$sum = $i = $u =  0;
				$sched_arr = array();
				$cashadv_arr = array();
				$casum = 0;
				$checkrow++;


				// select * wmployee where unpaid
				$sql8 = "SELECT * FROM schedule_employee WHERE status='Unpaid' AND employee_id=?";
				$qry8 = $connection->prepare($sql8);
				$qry8->bind_param('i',$employe_id);
				$qry8->execute();
				$qry8->bind_result($schemid,$dbsid,$dbeid,$dbs);
				$qry8->store_result();
				while($row = $qry8->fetch()) {
	
							// schedule
							$sql3 = "SELECT schedule.id,job.name,schedule.date,job.rate FROM schedule LEFT JOIN job ON job.id = schedule.job_id WHERE schedule.id = ?";
							$qry3 = $connection->prepare($sql3);
							$qry3->bind_param('i',$dbsid,);
							$qry3->execute();
							$qry3->bind_result($schedid,$dbn,$dbd,$dbr);
							$qry3->store_result();
							$qry3->fetch();

							$sched_arr[$i] = $schedid;
							$i++;
							$sum = $sum + $dbr;
				
				}
				// deduction 
				$sum = $sum - $weekdbdsum;

				$sql6 = "SELECT * FROM cash_advance WHERE employee_id=? AND status ='Unpaid' ";
				$qry6 = $connection->prepare($sql6);
				$qry6->bind_param('i',$dbeid);
				$qry6->execute();
				$qry6->bind_result($caid,$dbeid, $dba,$dbd,$dbs);
				$qry6->store_result();

				while($qry6->fetch ()) {
				

					$sum = $sum - $dba;

					$cashadv_arr[$u] = $caid;
					$u++;
				}

				$sql7 = "INSERT INTO payslip(employee_id,payslip_code,date,total) VALUES(?,?,?,?)";
				$qry7 = $connection->prepare($sql7);
				$qry7->bind_param('isss',$employe_id,$payslip_code,$today,$sum);
				$qry7->execute();

				$last_id = $connection->insert_id;

				foreach($sched_arr as $sa){
					$sql2 = "UPDATE schedule_employee SET status='Paid' WHERE schedule_id=? AND employee_id=?";
					$qry2 = $connection->prepare($sql2);
					$qry2->bind_param('ii',$sa,$employe_id);
					$qry2->execute();

					$sql33 = "INSERT INTO payslip_schedule(schedule_id,payslip_id) VALUES(?,?)";
					$qry33 = $connection->prepare($sql33);
					$qry33->bind_param('ii',$sa,$last_id);
					$qry33->execute();
				}foreach($cashadv_arr as $ca){
					$sql99 = "UPDATE cash_advance SET status='Paid' WHERE employee_id=?";
					$qry99 = $connection->prepare($sql99);
					$qry99->bind_param('i',$employe_id);
					$qry99->execute();

					$sql44 = "INSERT INTO payslip_cash_advance(cash_advance_id,payslip_id) VALUES(?,?)";
					$qry44 = $connection->prepare($sql44);
					$qry44->bind_param('ii',$ca,$last_id);
					$qry44->execute();
				}	


			}
		
			if($checkrow == 0){
				echo "<script>alert('There are no Unpaid Work Schedule for all employees yet.')</script>";
			}
			
			



	}
			


?>

 
<!-- Main content -->
<section class="content">
	<?php 
		if(isset($_GET['status'])){
			if($_GET['status'] == 'created'){
				echo "<script>alert('Successfully Added.')</script>";
	               
	          
			}if($_GET['status'] == 'updated'){
				echo "<script>alert('Successfully Updated.')</script>";
			}if($_GET['status'] == 'deleted'){
				echo "<script>alert('Successfully Deleted.')</script>";
			}
		}
	?>

	<div class="box">
		<div class="box-header">
			<h2>Employee Payroll</h2>
			<span class="pull-left"><a href="issue_payslip.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus-circle"></i> Issue Individual
			 Payslip</a></span>
			 <form action="#" method="POST">
				<span style="margin-left:5px"><button type="submit" onclick="return confirm('do you really want to process all employee payslip?')" name="btnBulk" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Issue Bulk Payslip</button></span>
			
			</form> 
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead 	>
				<tr>
					<th>Payslip Code</th>
					<th>Employee Name</th>
					<th>Date Issued</th>
					<th>Total</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM payslip";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbeid, $dbp,$dbd,$dbt);
					$qry->store_result();

					while($qry->fetch ()) {

						$sql2 = "SELECT firstname,lastname FROM employee where id=?";
						$qry2 = $connection->prepare($sql2);
						$qry2->bind_param('i',$dbeid);
						$qry2->execute();
						$qry2->bind_result($dbf,$dbl);
						$qry2->store_result();
						$qry2->fetch();


						echo"<tr>";
						echo"<td>";
						echo $dbp;
						echo"</td>";
						echo"<td>";
						echo $dbf." ".$dbl;
						echo"</td>";
						echo"<td>";
						echo $dbd;
						echo"</td>";
						echo"<td>";
						echo $dbt;
						echo"</td>";
						echo"<td>";
						

							?>
							<a title="Print" class="btn btn-warning btn-sm" onclick="window.open('print_payslip.php?id=<?php echo $id ?>', 
							                         'newwindow', 
							                         'width=500,height=500'); 
							              return false;" ><i class="fa fa-print"></i> Print Payslip</a>
							<?php
							
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Issue Employee Payslip</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<select class="form-control" id="select_employee">
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
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" id="btnSelect" class="btn btn-primary"><i class="fa fa-check"></i> Select</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->	
<script type="text/javascript">
	$('#btnSelect').click(function(){
		var employee_id = $('#select_employee').val();
		if(employee_id){
			window.location.href= "issue_payslip.php?id="+employee_id;
		}
	});
</script>


