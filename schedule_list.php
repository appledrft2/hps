<?php $title = "Schedule List" ?>
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

	<div class="box">
		<div class="box-header">
			<h2>List of Work Schedule</h2>
			<span class="pull-left"><a href="add_schedule.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Work Schedule</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead >
				<tr>
					<th>Work Name</th>
					<th>Date</th>
					<th>Rate (per employee)</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT schedule.id,job.name,schedule.date,job.rate FROM schedule LEFT JOIN job ON job.id = schedule.job_id";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbn, $dbd,$dbr);
					$qry->store_result();

					while($qry->fetch ()) {
						echo "<tr>";
						echo "<td>";
						echo $dbn;
						echo "</td>";
						echo "<td>";
						echo $dbd;
						echo "</td>";
						echo "<td>";
						echo $dbr;
						echo "</td>";
						echo "<td>";
						echo '<a class="btn btn-success btn-sm" href="manage_schedule_employee.php?id='.$id.'"><i class="fa fa-users"></i></a>
							<a class="btn btn-primary btn-sm" href="edit_schedule.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a href="delete_schedule.php?id='.$id.'" ';?>onclick="return confirm('do you really want to delete this record?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
						echo"</td>";
						echo "</tr>";

					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

