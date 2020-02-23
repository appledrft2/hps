<?php 

if(isset($_GET['id'])){
	include('includes/autoload.php');
	$sql = "DELETE FROM schedule_employee WHERE id=?";
	$qry = $connection->prepare ($sql);
	$qry->bind_param("i",$_GET['id']);
	if($qry->execute()){
		
		echo '<script>window.location.href="manage_schedule_employee.php?id='.$_GET['sid'].'"</script>';
	}
}

 ?>