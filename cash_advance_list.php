<?php $title = "Cash Advance List" ?>
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
			<h2>List of Cash Advance</h2>
			<span class="pull-left"><a href="add_cash_advance.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Issue Cash Advance</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead >
				<tr>
					<th>Employee</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Status</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM cash_advance";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$eid, $dba,$dbdate,$dbstatus);
					$qry->store_result();

					while($qry->fetch ()) {

						$sql2 = "SELECT firstname,lastname FROM employee WHERE id = ?";
						$qry2 = $connection->prepare($sql2);
						$qry2->bind_param('i',$eid);
						$qry2->execute();
						$qry2->bind_result($dbf, $dbl);
						$qry2->store_result();
						$qry2->fetch();

						$fullname = $dbf." ".$dbl;

						echo"<tr>";
						echo"<td>";
						echo $fullname;
						echo"</td>";
						echo"<td>";
						echo $dba;
						echo"</td>";
						echo"<td>";
						echo $dbdate;
						echo"</td>";
						echo"<td>";
						echo $dbstatus;
						echo"</td>";
						echo"<td>";
						echo '<a class="btn btn-primary btn-sm" href="edit_cash_advance.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a href="delete_cash_advance.php?id='.$id.'" ';?>onclick="return confirm('do you really want to delete this record?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

