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
                margin-right: : 4cm;
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
        <center><h5>Retribusi Pelabuhan <br> Bau bau</h5></center>
        <table id="id_table">
            <tr>
                <td><strong>Nama</strong></td>
                <td>: <?php echo $klien->nama_klien;?></td>
            </tr>
        </table>
        <hr>
        <div id="id_table">
        <h3>Daftar Transaksi</h3>
        <?php 

        if(!empty($data)){
        $c=1; foreach($data as $index =>$key){
            $query = $this->db->query('update beli_tiket set status=1 where id_bt='.$key->id_bt.' and status =0');
        ?>
        <table style="padding-left: 10px">    
            <tr>
                <td><strong>Jenis Tarif <?php echo $c++;?>:</strong></td>
                <td ><?php echo $key->jenis_tarif; ?></td>
            </tr>

            <tr>
                <td><strong>Tanggal Beli:</strong></td>
                <td ><?php $dsk=explode("-", $key->tgl_beli); $sd = explode(" ", $dsk[2]);  echo $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1] ?></td>
            </tr>
            <tr>
                <td><strong>Quantitas:</strong></td>
                <td >  <?php echo $key->qty; ?></td>
            </tr>
            <tr>
                <td><strong>Total Retribusi:</strong></td>
                <td >  <label class="jumlah_total" id="jumlah_total_<?php echo $index?>"> <?php echo number_format($key->jumlah_total,0,',',','); ?></label></td>
            </tr>
          
        </table>
         <hr>
          <?php } ?>
             <h3 id="Total_Deposit_Anda"></h3>
             <h3 id="total_keseluruhan"></h3>
             <h3 id="sisa_keseluruhan"></h3>
             <input type="hidden" name="sisa_deposit" value="<?php echo $sisa_deposit->total_deposit; ?>">
          <?php }else{?>
            <h3>Hari Ini Kosong</h3>
          <?php }?>
        </div>
        <br>
        <center><img src="<?php echo site_url('Main/set_barcode/'.$klien->kode_barcode)?>"></center>
    </div>
</body>
<script type="text/javascript">
    var arrays=[];
    
    $(document).on('ready', function(){
        var regex = new RegExp(',', 'g'); 
        var total_keseluruhan;
        var sisa_deposit;
        var sisa_keseluruhan;
        var sisa_depos = parseInt($('[name="sisa_deposit"]').val());
        $('.jumlah_total').each(function(index){
           // console.log($('#jumlah_total_'+index).text());
            arrays.push(parseInt($('#jumlah_total_'+index).text().replace(regex,'')));
        });
        
        console.log(arrays.reduce(getSum));
        total_keseluruhan=arrays.reduce(getSum);
        sisa_deposit=sisa_depos+arrays.reduce(getSum);
        sisa_keseluruhan=sisa_deposit-arrays.reduce(getSum);
        $('#Total_Deposit_Anda').html("Total Deposit :"+format1(sisa_deposit,'Rp.'));
        $('#total_keseluruhan').html("Total Pembayaran :"+format1(total_keseluruhan,'Rp.'));
        $('#sisa_keseluruhan').html("Sisa Deposit :"+format1(sisa_keseluruhan,'Rp.'));

    });
    
    function getSum(total, num) {
            return total + num;
    }


    function format1(n, currency) {
            return currency + " " + n.toFixed(0).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
    }
</script>
</html>