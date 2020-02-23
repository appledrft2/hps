
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h2>New Job</h2>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Name </label>
						<input placeholder="Enter Name" required type="text" class="form-control" name="name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Rate (per employee)</label>
						<input placeholder="Enter Rate" required type="text" class="form-control" name="rate">
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
 	 		$sql = "INSERT INTO job(name,rate) VALUES(?,?)";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ss",$_POST['name'],$_POST['rate']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=job_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=job_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

