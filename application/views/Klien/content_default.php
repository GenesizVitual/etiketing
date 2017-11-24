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
            <?php if($this->session->level_user == 1 or $this->session->level_user == 0){?>
            <div class="row">
                <div class="col-lg-12" style="padding-bottom: 20px">
                    <a href="<?php echo site_url('Klien/form_insert');?>" class="btn btn-outline btn-success col-lg-12">Tambah Penumpang</a>
                </div>
            </div>
            <?php } ?>
            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Penumpang
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nik</th>
                                                <th>Penumpang</th>
                                                <th>Kode Barcode</th>
                                                <th>TTL</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>RT/RW</th>
                                                <th>Desa</th>
                                                <th>Kec</th>
                                                <th>Kab</th>
                                                <th>Pekerjaan</th>
                                                <th>Warga negara</th>
                                                <th>Satus</th>
                                                <th>Kontrol</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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

  <script>
     var socket = io.connect( 'http://'+window.location.hostname+':3000' );
            $(document).ready(function() {
                $('#dataTables-example1').DataTable({
                    "ajax" : {
                        "url" : "<?php echo site_url('Klien/get_data/')?>"+null,
                        "type": "POST"
                    },responsive: true
                });

                proses_registrasi = function(id){
                $.ajax({
                    url  : "<?php echo site_url('Registrasi/register/')?>"+id,
                    type : "GET",
                    dataType : "JSON",
                    success: function(data)
                    {   
                        if(data.output == true)
                        {
                            socket.emit('total_registrasi_klien',{
                                total_registrasi_klien : data.total_registrasi_klien
                            });
                            window.location.href="<?php echo site_url('Registrasi/Data')?>";
                        }else{
                              window.location.href="<?php echo site_url('Registrasi/Data')?>";
                        }
                    }
                    });
                }

            });
</script>