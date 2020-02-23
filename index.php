<?php 
	include('header.php');
?>

<?php 

$sql = "SELECT count(*) FROM employee";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($te);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

 ?>
 <?php 

$sql = "SELECT count(*) FROM job";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($tj);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

 ?>
 <?php 

$sql = "SELECT count(*) FROM schedule";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($ts);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

 ?>
  <?php 

$sql = "SELECT count(*) FROM payslip";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($tp);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

 ?>
 
 

<!-- Main content -->
<section class="content">

	<!-- Small boxes (Stat box) -->
	      <div class="row">
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php echo $te; ?></h3>

	              <p>Employee</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-users"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3><?php echo $tj; ?></h3>

	              <p>Jobs</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-cogs"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-yellow">
	            <div class="inner">
	              <h3><?php echo $ts; ?></h3>

	              <p>Schedule</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-calendar"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?php echo $tp; ?></h3>

	              <p>Issued payslip</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-bar-chart"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	      </div>
	      <!-- /.row -->
 

</section>


<?php include('footer.php'); ?>


