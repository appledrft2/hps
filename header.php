
<?php
  session_start();
    if(empty(isset($_SESSION['dbu']))){
        header("location:login.php");
    }
    
?>
<?php 

  if(isset($_POST['btnLogout'])){
    session_unset();
    header('location:login.php');
  }

 ?>
<?php include('includes/autoload.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hacienda Payroll System  <?php if(isset($title)){echo '| '.$title;} ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>dist/css/skins/_all-skins.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>plugins/pace/pace.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/select2/dist/css/select2.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>HPS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Hacienda Payroll System</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calendar"></i>
               <span><?php echo date('l, M d Y') ?></span>
            </a>

          </li>
        </ul>
             

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">


   
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $baseurl ?>dist/img/avatar5.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['dbrole'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo $baseurl ?>dist/img/avatar5.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['dbu'] ?> - <?php echo $_SESSION['dbrole'] ?>
                   
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="">
                    <form method="POST" action="#">
                      <button name="btnLogout" class="btn btn-block btn-default btn-flat">Sign out</button>
                    </form>
                    
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
              
              </ul>
            </li>
            
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="index.php">
              <i class="fa fa-tachometer"></i> <span>Dashboard</span>
            </a>
          </li>
           <li>
            <a href="employee_list.php">
              <i class="fa fa-users"></i> <span>Employee</span>
            </a>
          </li> 
          <li>
            <a href="job_list.php">
              <i class="fa fa-cogs"></i> <span>Job</span>
            </a>
          </li> 
          <li>
            <a href="schedule_list.php">
              <i class="fa fa-calendar"></i><span>Schedule</span>
            </a>
          </li>
          <li>
            <a href="payroll_list.php">
              <i class="fa fa-list"></i><span>Payroll</span>
            </a>
          </li>

          <li class="header">SETTINGS</li>

          <li>
            <a href="deduction_list.php">
              <i class="fa fa-money"></i><span>Deductions</span>
            </a>
          </li>
          <li>
            <a href="cash_advance_list.php">
              <i class="fa fa-money"></i><span>Cash Advances</span>
            </a>
          </li>
          


          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
 
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
          <h1 class="col-md-6 text-left">
            <span class="text-left"></span>

          </h1>
          
        </div>
      </section>