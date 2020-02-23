<?php 
  if(isset($_GET['id'])){
    include('includes/autoload.php');
    $sql = "SELECT * FROM payslip WHERE id=?";
    $qry = $connection->prepare($sql);
    $qry->bind_param('i',$_GET['id']);
    $qry->execute();
    $qry->bind_result($id,$dbeid, $dbpc,$dbd,$dbtotal);
    $qry->store_result();
    $qry->fetch ();

    $sql2 = "SELECT * FROM employee WHERE id=?";
    $qry2 = $connection->prepare($sql2);
    $qry2->bind_param('i',$dbeid);
    $qry2->execute();
    $qry2->bind_result($id,$dbf, $dbl,$dbc,$dbg,$dba);
    $qry2->store_result();
    $qry2->fetch ();

    $fullname = $dbf." ".$dbl;

  }

?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Print Payslip</title>
</head>
<body onload="window.print()">
  <p style="text-align: center;"><span >Hacienda Payroll System</span></p>
  <p style="text-align: center;"><strong>EMPLOYEE PAYSLIP</strong></p>

   <p style="text-align:left;">
      Employee Name: <b><?php echo $fullname; ?></b>
      <span style="float:right;">
          Payslip Code: <b><?php echo $dbpc ?></b>
      </span>
  </p>
  <p style="text-align: right;">Date Issued: <b><?php echo $dbd; ?></b></p>
  <table border="0" style="width: 100%;">
    <tr>
      <th colspan="3" style="width: 50.0000%;">Weekly Work Schedule</th>
    </tr>
    <tr >
      <th style="border:1px solid black">Work Name</th>
      <th style="border:1px solid black">Date</th>
      <th style="border:1px solid black" >Rate</th>
    </tr>
      <?php 

      $sql3 = "SELECT * FROM payslip_schedule WHERE payslip_id=?";
      $qry4 = $connection->prepare($sql3);
      $qry4->bind_param('i',$_GET['id']);
      $qry4->execute();
      $qry4->bind_result($id,$sid, $psid);
      $qry4->store_result();
      $stotal=0;
      while($qry4->fetch()){
        $sql4 = "SELECT schedule.id,job.name,schedule.date,job.rate FROM schedule LEFT JOIN job ON job.id = schedule.job_id WHERE schedule.id=?";
        $qry5 = $connection->prepare($sql4);
        $qry5->bind_param('i',$sid);
        $qry5->execute();
        $qry5->bind_result($id,$dbn, $dbsd,$dbr);
        $qry5->store_result();
        $qry5->fetch();

      echo  "<tr>";
      echo "<td style='text-align: center;'>".$dbn."</td>";
      echo "<td style='text-align: center;'>".$dbsd."</td>";
      echo "<td style='text-align: right;'>".number_format($dbr,2)."</td>";
      echo "</tr>";
      $stotal = $stotal + $dbr;
      }

      ?>
    
    <tr>
      <td></td>
      <td></td>
      <td style="text-align: right;"><b><?php echo number_format($stotal,2) ?></b></td>
    </tr>
    <tr>
      <td></td>
      <th>Deductions</th>
      <?php 

      $sql3 = "SELECT sum(deduction) FROM deduction";
      $qry4 = $connection->prepare($sql3);
      $qry4->execute();
      $qry4->bind_result($dded);
      $qry4->store_result();
      $qry4->fetch();

      $weekly = $dded / 4;

      ?>
      <td style="text-align: right;"><?php echo number_format($weekly,2) ?></td>
    </tr>
    <tr>
      <td></td>
      <th>Cash Advance</th>
      <?php 

      $sql4 = "SELECT * FROM payslip_cash_advance WHERE payslip_id=?";
      $qry5 = $connection->prepare($sql4);
      $qry5->bind_param('i',$_GET['id']);
      $qry5->execute();
      $qry5->bind_result($id,$ca_id,$pid);
      $qry5->store_result();
      $cash_advance_total = 0;
      while($qry5->fetch()){

              $sql5 = "SELECT amount FROM cash_advance WHERE id=?";
              $qry6 = $connection->prepare($sql5);
              $qry6->bind_param('i',$ca_id);
              $qry6->execute();
              $qry6->bind_result($dbcaa);
              $qry6->store_result();
              $qry6->fetch();
              
              $cash_advance_total = $cash_advance_total + $dbcaa;


      }

      

      ?>
      <td style="text-align: right;"><?php echo number_format($cash_advance_total,2); ?></td>
    </tr>
    <tr>
      <td></td>
      <th>Total</th>
      <td style="text-align: right;"><b><?php echo number_format($dbtotal,2); ?></b></td>
    </tr>
  </table>
  <br>
  

</body>
</html>