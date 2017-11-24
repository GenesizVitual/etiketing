<!DOCTYPE html>
<html>
<head>

	<title>Test Kartu</title>


    <!-- Custom Fonts -->
    <link href="<?php echo base_url().'resource/template/css/'?>font-awesome.min.css" rel="stylesheet" type="text/css">


 <style type="text/css">
 .head
 {
 	 background-image: url('<?php echo base_url().'resource/kartu nama.png'?>');
 	 background-size: 500px 305px;
 	 background-repeat: no-repeat;
     width: 300mm;
     padding-top: 100px;
 }


label{
	color: #000000;
	font-family: "calibri";
}
/*
 @media print {
              -webkit-print-color-adjust: exact;
        }

*/ </style>
<script type="text/javascript">
	//window.open();
	window.print();
</script>
</head>
<body class="head">

		<div style="padding-left: 10px; padding-top: 30px;">
				<label style="padding-left: 10px;"><?php echo $nama_klien;?></label><br>
				<img src="<?php echo site_url().'/main/set_barcode/'.$kode_barcode;?>" style="padding-top: 10px" width="270">
		</div>
	
</body>
</html>