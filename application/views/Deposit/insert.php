    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
            </div>   

            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Form Deposit
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form action="#" method="POST" id="deposit">
                                <?php //echo form_open(site_url('Deposit/insert'), array('form'=>'role'))?>
                                    <input type="hidden" name="id_klien" value="<?php echo $data->id_klien;?>">
                                        <div class="form-group">
                                                <label>Nama Klien</label>
                                                <input class="form-control" type="input" name="nama_klien" readonly value="<?php echo $data->nama_klien?>">
                                                <?php echo form_error('nama_klien');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Kode Barcode</label>
                                                <input class="form-control" type="input" name="kode_barcode" value="<?php echo $data->kode_barcode;?>" readonly>
                                                <?php echo form_error('kode_barcode');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Jumlah Deposit</label>
                                                <input class="form-control" type="input" name="jumlah_deposit">
                                                <?php echo form_error('jumlah_deposit');?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" onclick="deposits()" class="btn btn-success">Proses</button>
                                            <button type="reset" class="btn btn-danger">Batal</button>
                                        </div>
                                <?php // echo form_close();?>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
        </div>
    </div>
    <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

    <script type="text/javascript">
         var socket = io.connect( 'http://'+window.location.hostname+':3000' );
        $(document).on("ready", function(){

            deposits = function()
            {
                //alert("test");
                $.ajax({
                    url: "<?php echo site_url('Deposit/insert');?>",
                    type: "POST",
                    dataType : "JSON",
                    data : $('#deposit').serialize(),
                    success : function(data)
                    {
                       console.log(data);
                        if(data.output == true){
                            socket.emit('total_deposit', {
                                total_deposit : data.total_deposit
                            });
                            window.location.href="<?php echo site_url('Deposit/lihat_deposit/')?>"+data.id;
                        }
                    }
                });
            }

        });
    </script>