<!DOCTYPE html>
<html>
<head>
	<title>Print Laporan Tanggal</title>
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
	                size: landscape;
	             }
	        }
	</style>
</head>
<body>
	<div id="simper">
	<table width="100%">
		<tr>
			<td style="width: 90px;"><img src="<?php echo base_url()?>/resource/Dishub.png" width="100%"></td>
			<td align="center">
				<h2 style="margin-bottom: 0px;margin-top: 0px;">DINAS PERHUBUNGAN PROVINSI <br> Sulawesi Tenggara</h2>
				<h3 style="margin-top: 0px;margin-bottom: 10px;">Laporan Penerimaan Retribusi <br> Pelabuhan Bau Bau</h3>
			</td>
			<td></td>
		</tr>	
	</table>
	
	<hr>
	<div style="width: 100%; text-align: right; padding-bottom: 10px">
		<label style="padding-right: 5%; ">Tanggal : <?php echo Date('d-M-Y', Time());?></label>
	</div>
	<div style="width: 100%; text-align: left; padding-bottom: 10px">
		<label style="padding-right: 5%; ">Jumlah data Retribusi Klien : <?php echo count($data);?></label>
	</div>

	<table border="1" width="100%" id="table">
		<thead>
			<tr>
                <th>No</th>
                <th>Tanggal Retribusi</th>
                <th>Jenis Retribusi</th>
                <th>Jenis Tarif</th>
                <th>Quantitas</th>
                <th>Harga</th>
                <th>Jumlah Total</th>
                <th>Petugas</th>
            </tr>
		</thead>
		<tbody>
			<?php if(!empty($data)) {?>
			<?php foreach($data as $key){?>
			<tr>
					<td align="center"><label><?php echo $key[0]?></label></td>
					<td><label><?php echo $key[1]?></label></td>
					<td><label><?php echo $key[2]?></label></td>
					<td><label><?php echo $key[3]?></label></td>
					<td><label><?php echo $key[4]?></label></td>
					<td><label><?php echo $key[5]?></label></td>
					<td><label><?php echo $key[6]?></label></td>
					<td><label><?php echo $key[7]?></label></td>
			</tr>	
			<?php }?>
			<tr>
				<td colspan="7" align="center"><strong>Total Retribusi</strong></td>
				<td><strong>Rp. <?php echo number_format($total->jumlah_total,0,'.','.');?></strong></td>
			</tr>
			<?php }else{?>
				<tr>
					<td colspan="8" align="center"><strong>Data Retribusi Kosong</strong></td>
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
	            		<br><?php echo $kepala_uptd->nip;?></strong>
	            	<?php }?>
	    		</th>
	            </tr>
			</thead>
		</table>
	</div>


</body>
</html>