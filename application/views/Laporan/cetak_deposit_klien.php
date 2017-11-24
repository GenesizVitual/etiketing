<!DOCTYPE html>
<html>
<head>
    <title>Cetak Tiket</title>
    <script src="<?php echo base_url().'resource/'?>jQuery-2.2.0.min.js"></script>
    <style type="text/css">
       #id_conent
       {
            height: 100%;
            width: 100%;
       } 

       #id_table{
            padding-left: 10px;
       }
      /* body
        {
          margin: 25mm 25mm 25mm 25mm;
        }*/
        @media print{
            @page {
                margin-top: 1cm;
                margin-left: 0.50cm;
                margin-right: : 2cm;
                size: portrait;
             }
        }
    </style>
    <script type="text/javascript">
       window.print();
      
    </script>

</head>

<body>
    <div id="id_conent">
        <center><h3>Dinas Perhubungan</h3></center>
        <center><h4>Provinsi Sulawesi Tenggara</h4></center>
        <center><h5>Isi Ulang Kartu E-Tiketing<br> Pelabuhan Bau bau</h5></center>
       
        <hr>
        <div id="id_table">
        <h3>Struk Deposit</h3>
        <?php 

        if(!empty($data)){?>
    
        <table style="padding-left: 10px">    
            <tr>
                <td><strong>Nama :</strong></td>
                <td > <?php echo $data->nama_klien; ?></td>
            </tr>

            <tr>
                <td><strong>Tanggal Beli:</strong></td>
                <td ><?php $dsk=explode("-", $data->tgl_depos); $sd = explode(" ", $dsk[2]);  echo $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1] ?></td>
            </tr>
            <tr>
                <td><strong>Jumlah Deposit:</strong></td>
                <td ><?php echo "Rp ".number_format($data->jumlah_depos,0,',',',');?></td>
            </tr>
            <tr>
                <td><strong>Saldo Sekarang:</strong></td>
                <td ><?php $total_deposit = $this->db->select('total_deposit')->where('id_klien', $data->id_klien)->get('total_deposit')->row();
                 echo "Rp ".number_format($total_deposit->total_deposit,0,',',',');?></td>
            </tr>
           <!--  <tr>
                <td><strong>Quantitas:</strong></td>
                <td >  <?php echo $key->qty; ?></td>
            </tr>
            <tr>
                <td><strong>Total Retribusi:</strong></td>
                <td >  <label class="jumlah_total" id="jumlah_total_<?php echo $index?>"> <?php echo number_format($key->jumlah_total,0,',',','); ?></label></td>
            </tr> -->
          
        </table>
       
         <hr>

        </div>
        <br>
        <center><img src="<?php echo site_url('Main/set_barcode/'.$data->kode_barcode)?>"></center>
         <?php }?>
    </div>
</body>
<script type="text/javascript">
</script>
</html>