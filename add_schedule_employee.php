<?php 
	if(isset($_POST['btnAddEmployee'])){
		$status = "Unpaid";
		$sql ="INSERT INTO schedule_employee(schedule_id,employee_id,status) VALUES(?,?,?)";
		$qry->prepare($sql);
		$qry->bind_param('iis',$_POST['schedule_id'],$_POST['employee_id'],$status);
		if($qry->execute()) {

			echo '<meta http-equiv="refresh" content="2; URL=manage_schedule_employee.php?id='.$_POST['schedule_id'];
		}
	}
?>