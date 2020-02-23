<?php $title = "Deduction List" ?>
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
			<h2>List of Deductions</h2>
			<span class="pull-left"><a href="add_deduction.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Deduction</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead >
				<tr>
					<th>Name</th>
					<th>Salary Range</th>
					<th>Deduction</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM deduction";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbn, $dbs,$dbd);
					$qry->store_result();

					while($qry->fetch ()) {
						echo"<tr>";
						echo"<td>";
						echo $dbn;
						echo"</td>";
						echo"<td>";
						echo $dbs;
						echo"</td>";
						echo"<td>";
						echo $dbd;
						echo"</td>";
						echo"<td>";
						echo '<a class="btn btn-primary btn-sm" href="edit_deduction.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a href="delete_deduction.php?id='.$id.'" ';?>onclick="return confirm('do you really want to delete this record?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

