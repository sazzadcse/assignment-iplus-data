<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="User Registration">
    <meta name="author" content="Iplus-Data">
    <meta name="keywords" content="User Registration">

    <!-- Title Page-->
    <title>User Registartion</title>

    <!-- Icons font CSS-->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap-grid.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap-reboot.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/mdi-font/css/material-design-iconic-font.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/font-awesome-4.7/css/font-awesome.min.css'); ?>" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="<?php echo base_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/datepicker/daterangepicker.css'); ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/vendor/toastr/toastr.min.css'); ?>" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet" media="all">

    <script type="text/javascript">
      var $baseUrl = "<?php echo base_url();?>";
      var $examinations = <?php echo json_encode( $examinations );?>;
      var $universities = <?php echo json_encode( $universities );?>;
      var $boards = <?php echo json_encode( $boards );?>;
    </script>

</head>

<body>

    <div class="page-wrapper bg-gra-02 p-t-30 p-b-30 font-poppins">
        
		<?php echo !empty($layout) ? $layout : ''; ?>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <!-- Vendor JS-->
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/validation/jquery.validate.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/validation/additional-methods.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/toastr/toastr.min.js'); ?>"></script>

    <!-- Main JS-->
    <script src="<?php echo base_url('assets/js/frontend_global.js'); ?>"></script>

    <script type="text/javascript">
      /*jQuery(document).ready(function(){
        
      });*/
   </script>

</body>

</html>
<!-- end document-->
