<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset(generalSettings()->title) ? generalSettings()->title:'ULT'?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo isset(generalSettings()->logo)?base_url('assets/images'.'/'.generalSettings()->logo): base_url('assets/images/AdminLTELogo.png') ?>" type="image/x-icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.css" rel="stylesheet">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- datatable -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatable/dataTables.bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatable/responsive.bootstrap.min.css" type="text/css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ichecks/icheck.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen/bootstrap-chosen.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js">
  <style>
    /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    .select2-selection{
      height: 37px !important;
    }
    .i-checks{
      opacity:1 !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  <?php
    $CI = & get_instance();
  ?>
    <!-- Navbar -->
    <?php  $CI->load->view('admin/layout/header') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php  $CI->load->view('admin/layout/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <!-- <div class="container-fluid"> </div> -->
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <?php  $CI->load->view($content) ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php  $CI->load->view('admin/layout/footer') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
    var base_url = '<?php echo base_url() ?>';
  </script>
  <script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>

  <!-- DataTable -->
   <script src="<?php echo base_url() ?>assets/plugins/datatable/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatable/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatable/responsive.bootstrap.min.js" type="text/javascript"></script>

  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- Sweet Alert -->
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>


  <script src="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/ichecks/icheck.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/chosen/chosen.jquery.js"></script>



  <script src="<?php echo base_url() ?>assets/backend/custom.js"></script>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp7Zi6dH-t8ZagFruQ5He5UgSrIb5E47c&libraries=places"></script>

</body>

</html>
