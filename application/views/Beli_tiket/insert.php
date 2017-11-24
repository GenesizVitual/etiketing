    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
            </div>   

            <div class="row">

                <div class="col-lg-12">
                <?php if(!empty($this->session->flashdata('message_success'))){?>
                     <div class="alert alert-success">
                            <?php echo $this->session->flashdata('message_success');?>
                     </div>
                <?php }?>
                <?php if(!empty($this->session->flashdata('message_fail'))){?>
                     <div class="alert alert-warning">
                            <?php echo $this->session->flashdata('message_fail');?>
                     </div>
                 <?php }?>
                </div>

            </div>
            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Form Retribusi dan Beli Tiket
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php if(!empty($data)){?>
                                <form action="#" method="POST" id="retribusi">
                                <?php //echo form_open(site_url('Beli_tiket/insert'), array('form'=>'role'))?>
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
                                                <label>Total Deposit Sekarang</label>
                                                <input class="form-control" type="input" value="<?php echo $data->total_deposit?>" name="jumlah_deposit" readonly>
                                        </div>  
                                        <div class="form-group">
                                                <label>Quantitas</label>
                                                <input class="form-control" type="input" name="qty" placeholder="1" value="1">
                                        </div>
                                       
                                        <div class="form-group">
                                                <label>Jenis Tarif</label>
                                                <select class="form-control" name="jenis_tarif">
                                                    <option >Pilih Tarif</option>
                                                    <?php foreach($jt as $key){?>
                                                    <option value="<?php echo $key->id?>"><?php echo $key->jenis_tarif?></option>
                                                    <?php }?>
                                                </select>
                                                <?php echo form_error('jenis_tarif');?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" onclick="retribusi()" class="btn btn-success">Proses</button>
                                            <button type="reset" class="btn btn-danger">Batal</button>
                                        </div>
                                 </form>
                                 <?php }else{ ?>

                                    <div class="row">

                                        <div class="col-lg-12">
                                             <div class="alert alert-warning">
                                                    Klien Belum Melakukan Deposit   
                                             </div>
                                        </div>
                                    </div>

                                <?php }//echo form_close();?>
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

            retribusi = function()
            {
                //alert("test");
                $.ajax({
                    url: "<?php echo site_url('Beli_tiket/insert');?>",
                    type: "POST",
                    dataType : "JSON",
                    data : $('#retribusi').serialize(),
                    success : function(data)
                    {
                        if(data.output == true){
                            socket.emit('total_retribusi', {
                                total_retribusi : data.total_retribusi
                            });
                           window.location.href="<?php echo site_url('Beli_tiket');?>";
                        }
                        console.log(data);
                    }
                });
            }

        });
    </script>