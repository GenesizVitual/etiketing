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
                                Form Tarif
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form action="#" method="post" id="registrasi">
                                <?php //echo form_open(site_url('Jenis_tarif/insert'), array('form'=>'role'))?>
                                        <div class="form-group">
                                                <label>Jenis Tarif</label>
                                                <input class="form-control" type="input" name="jenis_tarif">
                                                <?php echo form_error('jenis_tarif');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Harga Tarif</label>
                                                <input class="form-control" type="input" name="harga_tarif">
                                                <?php echo form_error('harga_tarif');?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" onclick="proses_registrasi()" class="btn btn-success">Tambah</button>
                                            <button type="reset" class="btn btn-danger">Batal</button>
                                        </div>
                                <?php //echo form_close();?>
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
        $(document).on('ready', function(){

            proses_registrasi = function(id){
                $.ajax({
                    url  : "<?php echo site_url('Registrasi/register')?>",
                    type : "POST",
                    dataType : "JSON",
                    data : $('#registrasi').serialize(),
                    success: function(data)
                    {   
                        if(data.output == true)
                        {
                            socket.emit('total_registrasi_klien',{
                                total_registrasi_klien : data.total_registrasi_klien
                            });
                            window.location.href="<?php echo site_url('Registrasi/Data');?>";
                        }
                    }
                });
            }

        });
    </script>