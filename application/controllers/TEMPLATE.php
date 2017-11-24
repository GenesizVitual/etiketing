<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Etiketing Apps</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url().'resource/template/css/'?>font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url().'resource/template/css/'?>dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url().'resource/template/css/'?>dataTables/dataTables.responsive.css" rel="stylesheet">


    <script src="<?php echo base_url().'resource/'?>jquery-1.8.2.js"></script>

    <script src="<?php echo base_url().'resource/'?>jQuery-2.2.0.min.js"></script>

     <!-- Sweet Modal -->
  <script src="<?php echo base_url().'resource/dist';?>/sweetalert.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url().'resource/dist';?>/sweetalert.css">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <?php $this->load->view('sidebar');?>
    <!-- Page Content -->
    <?php $this->load->view($view);?>

</div>

<!-- jQuery -->
<script src="<?php echo base_url().'resource/template/'?>js/jquery.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url().'resource/template/'?>js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url().'resource/template/'?>js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url().'resource/template/'?>js/startmin.js"></script>
        <!-- DataTables JavaScript -->
<script src="<?php echo base_url().'resource/template/'?>js/dataTables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().'resource/template/'?>js/dataTables/dataTables.bootstrap.min.js"></script>


  <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>


</body>
</html>
