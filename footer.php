    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="<?php echo $baseurl; ?>">HPS</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo $baseurl; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $baseurl; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="<?php echo $baseurl; ?>bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $baseurl; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $baseurl; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $baseurl; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $baseurl; ?>dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo $baseurl; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseurl; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $baseurl; ?>dist/dtt/dataTables.buttons.min.js"></script>
<script src="<?php echo $baseurl; ?>dist/dtt/buttons.html5.min.js"></script>
<script src="<?php echo $baseurl; ?>dist/dtt/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $baseurl; ?>dist/dtt/buttons.print.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $baseurl; ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $baseurl; ?>bower_components/moment/min/moment.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $baseurl; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo $baseurl; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: true
    })
  })
</script>
<script type="text/javascript">
  $('#datatable1').DataTable({
    dom: 'Bfrtlp',
    buttons: {
                dom: {
                    button: {
                        className: 'btn btn-primary'
                    }
                },
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel'},
                    {extend: 'pdf'},
                    {extend: 'print'},
                    

                ]
            }
  });
</script>
<!-- page script -->
<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
      
      }
    })
  })
</script>
</body>
</html>
