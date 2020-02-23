<?php $title = "Payroll List" ?>
<?php include('header.php'); ?>


 
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
		<div class="box-header">
			<h2>Payslip List : <?php echo $dbf." ".$dbl."" ?></h2>
			<span class="pull-left"><a href="issue_payslip.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Issue Payslip</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead 	>
				<tr>
					<th>Payslip code</th>
					<th>Date</th>
					<th>Total</th>
					<th width="20%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM payslip WHERE employee_id =?";
					$qry = $connection->prepare($sql);
					$qry->bind_param('i',$_GET['id']);
					$qry->execute();
					$qry->bind_result($id,$dbeid, $dbp,$dbd,$dbt);
					$qry->store_result();

					while($qry->fetch ()) {
						echo"<tr>";
						echo"<td>";
						echo $dbp;
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

