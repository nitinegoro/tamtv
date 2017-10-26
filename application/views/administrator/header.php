<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> &raquo; <?php echo $this->options->get('sitename'); ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url("public/bootstraps/css/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/admin/css/style-admin.css"); ?>"> 
  <link rel="stylesheet" href="<?php echo base_url("public/font-awesome/css/font-awesome.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/plugins/select2/select2.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/admin/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/admin/css/style-admin.css"); ?>"> 
  <link rel="stylesheet" href="<?php echo base_url("public/admin/css/skins/skin-black-light.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/admin/css/animate.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/theme/css/daterangepicker-bs3.css"); ?>">
  
  <link rel="shortcut icon" href="<?php echo base_url("public/image/site/favicon.png"); ?>">
  <script src="<?php echo base_url("public/theme/js/jquery-3.2.1.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/bootstraps/js/bootstrap.min.js"); ?>"></script>
  <script src="<?php echo base_url('public/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
  <script src="<?php echo base_url("public/admin/js/app.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/admin/js/jquery.tableCheckbox.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/theme/js/moment.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/theme/js/daterangepicker.js"); ?>"></script>
  <script src="<?php echo base_url("public/tinymce/js/tinymce.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/plugins/select2/select2.full.min.js"); ?>"></script>
  <script src="<?php echo base_url("public/plugins/heightchart/highcharts.js"); ?>"></script>
  <script src="<?php echo base_url("public/admin/highcharts/modules/exporting.js"); ?>"></script>
  <script src="<?php echo base_url("public/admin/highcharts/modules/data.js"); ?>"></script>
  <script src="<?php echo base_url("public/admin/highcharts/modules/drilldown.js"); ?>"></script>
  <script src="<?php echo base_url("public/theme/js/jquery.sticky.min.js"); ?>"></script>
  <script type="text/javascript"> 
      var base_url   = '<?php echo site_url("administrator"); ?>';
      var base_path  = '<?php echo base_url('public'); ?>';
      var current_url = '<?php echo current_url(); ?>';
  </script>
</head>
<?php
/* End of file header.php */
/* Location: ./application/views/template/header.php */