<!DOCTYPE html>
<html>
<head>
	<title>Print Laporan Registrasi</title>
	<style type="text/css">
			#table {
			    border-collapse: collapse;
			}

			label{
				padding-left: 10px;
			}

			 @media print{
	            @page {
	                margin-top: 1cm;
	                margin-left: 1cm;
	                margin-right: : 1cm;
	                size: portrait;
	             }
	        }
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
	<div id="simper">
	<table width="100%">
		<tr>
			<td style="width: 90px;"><img src="<?php echo base_url()?>/resource/Dishub.png" width="100%"></td>
			<td align="center">
				<h2 style="margin-bottom: 0px;margin-top: 0px;">DINAS PERHUBUNGAN PROVINSI <br> Sulawesi Tenggara</h2>
				<h3 style="margin-top: 0px;margin-bottom: 10px;">Laporan Pembuatan Kartu E-Tiketing <br> Pelabuhan Bau Bau</h3>
			</td>
			<td></td>
		</tr>	
	</table>
	
	<hr>
	<div style="width: 100%; text-align: right; padding-bottom: 10px">
		<label style="padding-right: 5%; ">Tanggal : <?php echo Date('d-M-Y', Time());?></label>
	</div>
	<div style="width: 100%; text-align: left; padding-bottom: 10px">
		<label style="padding-right: 5%; ">Jumlah Card member yang telah teregistrasi : <?php echo count($data);?></label>
	</div>

	<table border="1" width="100%" id="table">
		<thead>
			<tr>
            <th >No</th>
            <th >Tanggal/Waktu Registrasi</th>
            <th>Kode Barcode</th>
            <th>Nama Klien</th>
            <th>Petugas</th>
            </tr>
		</thead>
		<tbody>
			<?php foreach($data as $key){?>
			<tr>
					<td align="center"><label><?php echo $key[0]?></label></td>
					<td><label><?php $dsk=explode("-", $key[1]); $sd = explode(" ", $dsk[2]);  echo $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1] ?></label></td>
					<td><label><?php echo $key[2]?></label></td>
					<td><label><?php echo $key[3]?></label></td>
					<td><label><?php echo $key[4]?></label></td>
			</tr>	
			<?php }?>
		</tbody>
	</table>
		<table style="padding-top: 50px" width="100%">
		<thead>
			<tr>
	            <th width="50%" align="center">
	            	<strong>Administrasi<br><br><br><br><br><br> 
	            	<?php $administrasi = $this->db->select('*')->from('user')->where('level', 4)->get()->row();
	            		if(!empty($administrasi)){
	            	?>
	            		<u><?php echo $administrasi->nama_user;?></u><br><?php echo $administrasi->nip;?> 
	           		<?php }?>
	           		</strong>
	            </th>
	            <th width="50%" align="center">
	            	<strong>Kepala UPTD<br><br><br><br><br><br> 
	            	<?php $kepala_uptd = $this->db->select('*')->from('user')->where('level', 5)->get()->row();
	            		if(!empty($kepala_uptd)){
	            	?>
	            		<u><?php echo $kepala_uptd->nama_user;?></u>
	            		<br><?php echo $kepala_uptd->nip;?></strong></th>
	            	<?php }?>
	            </tr>
			</thead>
		</table>
	</div>


</body>
</html>