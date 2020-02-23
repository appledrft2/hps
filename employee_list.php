<?php $title = "Employee List" ?>
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
			<h2>List of Employee</h2>
			<span class="pull-left"><a href="add_employee.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Employee</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead 	>
				<tr>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Contact</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM employee ORDER BY firstname";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbf, $dbl,$dbc,$dbg,$dba);
					$qry->store_result();

					while($qry->fetch ()) {
						echo"<tr>";
						echo"<td>";
						echo $dbf;
						echo"</td>";
						echo"<td>";
						echo $dbl;
						echo"</td>";
						echo"<td>";
						echo $dbc;
						echo"</td>";
						echo"<td>";
						echo $dbg;
						echo"</td>";
						echo"<td>";
						echo $dba;
						echo"</td>";
						echo"<td>";
						echo '<a class="btn btn-primary btn-sm" href="edit_employee.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a href="delete_employee.php?id='.$id.'" ';?>onclick="return confirm('do you really want to delete this record?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

